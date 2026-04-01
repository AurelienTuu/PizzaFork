<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PizzaModel;
use App\Models\IngredientModel;

class BagController extends BaseController
{
    protected $PizzaModel;
    protected $IngredientModel;
    protected $bag;

    public function __construct()
    {
        $this->PizzaModel = new PizzaModel();
        $this->IngredientModel = new IngredientModel();
        // On initialise le panier une seule fois pour tout le contrôleur
        $this->bag = \Config\Services::cart();
    }

    public function index()
    {
        $data['title'] = 'Votre panier';
        $data['bag'] = $this->bag;
        return view('Bag-index.php', $data);
    }

    public function add($id)
    {
        $pizza = $this->PizzaModel->find($id);
        if (!$pizza) {
            return redirect()->back();
        }

        // CORRECTION QUANTITÉ : On récupère d'abord la valeur, puis on force l'entier
        // Si vide ou non défini, on met 1.
        $postQty = $this->request->getPost('qty');
        $qty = (empty($postQty) || $postQty < 1) ? 1 : (int)$postQty;

        // RÉCUPÉRATION TAILLE : On s'assure de bien prendre la valeur du POST
        $sizeLabel = $this->request->getPost('size') ?? 'Moyenne';
        $extrasIds = $this->request->getPost('extras') ?? [];

        // Logique de prix
        $prices = ['Petite' => 10.00, 'Moyenne' => 12.50, 'Large' => 15.00];
        $basePrice = $prices[$sizeLabel] ?? 12.50;

        $extraPrice = count($extrasIds) * 1.0;
        $extrasNames = [];

        if (!empty($extrasIds)) {
            $ingredients = $this->IngredientModel->whereIn('id', $extrasIds)->findAll();
            foreach ($ingredients as $ing) {
                $extrasNames[] = $ing->text;
            }
        }

        // ID UNIQUE : On crée un identifiant basé sur les options pour éviter 
        // de fusionner une pizza "Large" avec une "Petite"
        $rowId = md5($id . $sizeLabel . serialize($extrasIds));

        $data = [
            'id'      => $rowId,
            'qty'     => $qty,
            'price'   => $basePrice + $extraPrice,
            'name'    => $pizza->text,
            'picture' => $pizza->picture,
            'options' => [
                'details'      => "Taille : " . $sizeLabel,
                'extras_names' => !empty($extrasNames) ? implode(', ', $extrasNames) : 'Aucun'
            ]
        ];

        $this->bag->insert($data);

        // On redirige vers le panier pour voir le résultat
        return redirect()->to('/')->with('message', 'Pizza ajoutée au panier !');
    }

    public function incQty(?string $rowid = null)
    {
        if (empty($rowid)) return redirect()->to('/bag/checkout');

        $items = $this->bag->contents();
        if (isset($items[$rowid])) {
            $this->bag->update([
                'rowid' => $rowid,
                'qty'   => (int)$items[$rowid]['qty'] + 1,
            ]);
        }

        return redirect()->to('/bag/checkout');
    }

    public function decQty(?string $rowid = null)
    {
        if (empty($rowid)) return redirect()->to('/bag/checkout');

        $items = $this->bag->contents();
        if (isset($items[$rowid])) {
            $currentQty = (int)$items[$rowid]['qty'];
            $newQty = $currentQty - 1;

            if ($newQty <= 0) {
                $this->bag->remove($rowid);
            } else {
                $this->bag->update([
                    'rowid' => $rowid,
                    'qty'   => $newQty,
                ]);
            }
        }

        return redirect()->to('/bag/checkout');
    }

    public function deleteItem(?string $rowid = null)
    {
        if (empty($rowid)) return redirect()->to('/bag/checkout');
        
        $this->bag->remove($rowid);
        return redirect()->to('/bag/checkout');
    }
}