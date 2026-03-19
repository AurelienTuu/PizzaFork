<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PizzaModel;

class BagController extends BaseController {

    public function index() {
        $data['title'] = 'Votre panier';
        $data['bag'] = \Config\Services::cart();
        return view('Bag-index.php', $data);
    }

    public function add($idPizza) {
        $pizzaModel = new PizzaModel();
        $pizza = $pizzaModel->find($idPizza);
        $bag = \Config\Services::cart();
        
        $bag->insert(
            array(
                'id'      => $idPizza,
                'qty'     => 1,
                'price'   => '10.50',
                'name'    => $pizza->text,
                'picture' => $pizza->picture,
            )
        );

        return redirect()->to('/');
    }
}