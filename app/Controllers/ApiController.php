<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
    private $clientId;
    private $clientSecret;
    private $baseUrl;

    public function __construct()
    {
        // On récupère les infos depuis le fichier .env via les variables d'environnement
        $this->clientId     = env('PAYPAL_CLIENT_ID');
        $this->clientSecret = env('PAYPAL_SECRET');
        
        // Définition de l'URL selon le mode
        $mode = env('PAYPAL_MODE', 'sandbox');
        $this->baseUrl = ($mode === 'sandbox') 
            ? "https://api-m.sandbox.paypal.com" 
            : "https://api-m.paypal.com";
    }

    /**
     * Étape 1 : Obtenir le jeton d'accès (Access Token)
     */
    private function getAccessToken()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . "/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Sécurité : On active la vérification SSL (important même en sandbox)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); 
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->clientId . ":" . $this->clientSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status !== 200) {
            return null;
        }

        $json = json_decode($result);
        return $json->access_token ?? null;
    }

    /**
     * Étape 2 : Créer la commande réelle
     */
    public function createOrder()
    {
        $bag = \Config\Services::cart();
        $total = $bag->total();

        if ($total <= 0) {
            return $this->fail("Le panier est vide ou invalide.", 400);
        }

        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return $this->fail("Erreur d'authentification PayPal. Vérifiez vos identifiants.", 500);
        }

        $orderData = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => "EUR",
                    "value" => number_format($total, 2, '.', '')
                ]
            ]]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . "/v2/checkout/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $accessToken
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));

        $result = curl_exec($ch);
        $json = json_decode($result);
        curl_close($ch);

        return $this->respond($json);
    }

    /**
     * Étape 3 : Capturer le paiement
     */
    public function captureOrder($orderID = null)
    {
        if (!$orderID) {
            return $this->fail("ID de commande manquant.", 400);
        }

        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return $this->fail("Erreur d'authentification PayPal.", 500);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . "/v2/checkout/orders/" . $orderID . "/capture");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $accessToken
        ]);
        curl_setopt($ch, CURLOPT_POST, true);

        $result = curl_exec($ch);
        $json = json_decode($result);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Analyse de la réponse
        if ($status === 201 && isset($json->status) && $json->status === 'COMPLETED') {
            
            // --- LOGIQUE MÉTIER ICI ---
            // 1. Enregistrer en BDD (ex: $orderModel->saveOrder($json))
            
            // 2. Vider le panier
            $bag = \Config\Services::cart();
            $bag->destroy();

            return $this->respond([
                'status' => 'success',
                'message' => 'Paiement validé et panier vidé',
                'details' => $json
            ]);
        }

        return $this->respond([
            'status' => 'error',
            'message' => 'Le paiement n\'a pas pu être capturé',
            'details' => $json
        ], 400);
    }
}