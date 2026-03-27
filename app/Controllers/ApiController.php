<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
    // Tes identifiants Sandbox
    private $clientId = "AZgdcCREt-e92TI2hQW1h0FZAjGRqQm8fD685aRsxvCguxwfI3gyQXcy8o9vw-I7rHl1HjMpdv9hb4lC";
    private $clientSecret = "EP2e14sed5-nf4M3gxNoh3Cek8q85EHqlQ3uuBAnNAqb0ezLNjbwoXJvZGAw4iWRZeyXtr_ZjjPrsRrZ";
    
    // URL de l'API Sandbox de PayPal
    private $baseUrl = "https://api-m.sandbox.paypal.com";

    /**
     * Étape 1 : Obtenir le jeton d'accès (Access Token) auprès de PayPal
     */
    private function getAccessToken()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . "/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // À mettre à true en production
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->clientId . ":" . $this->clientSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $result = curl_exec($ch);
        
        if(curl_errno($ch)) {
            return null;
        }

        $json = json_decode($result);
        curl_close($ch);

        return $json->access_token ?? null;
    }

    /**
     * Étape 2 : Créer la commande réelle sur les serveurs PayPal
     */
    public function createOrder()
    {
        $bag = \Config\Services::cart();
        $total = $bag->total();

        // Sécurité : Ne pas créer de commande si le panier est vide
        if ($total <= 0) {
            return $this->fail("Le panier est vide", 400);
        }

        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return $this->fail("Impossible d'obtenir le jeton PayPal", 500);
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
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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
     * Étape 3 : Capturer le paiement après validation de l'utilisateur
     */
    public function captureOrder($orderID)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return $this->fail("Erreur d'authentification PayPal", 500);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . "/v2/checkout/orders/" . $orderID . "/capture");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $accessToken
        ]);
        curl_setopt($ch, CURLOPT_POST, true);

        $result = curl_exec($ch);
        $json = json_decode($result);
        curl_close($ch);

        // Si le paiement est réussi
        if (isset($json->status) && $json->status === 'COMPLETED') {
            // 1. Ici tu peux appeler un modèle pour sauvegarder la commande en BDD
            
            // 2. Vider le panier
            $bag = \Config\Services::cart();
            $bag->destroy();
        }

        return $this->respond($json);
    }
}