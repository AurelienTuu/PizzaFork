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

        public function incQty(string $rowid = null) {
            $bag = \Config\Services::cart();
            if (empty($rowid)) {
                return redirect()->to('/bag/checkout');
            }

            $items = $bag->contents();
            if (!isset($items[$rowid])) {
                return redirect()->to('/bag/checkout');
            }

            $currentQty = (int) $items[$rowid]['qty'];
            $bag->update([
                'rowid' => $rowid,
                'qty'   => $currentQty + 1,
            ]);

            return redirect()->to('/bag/checkout');
        }

        public function decQty(string $rowid = null) {
            $bag = \Config\Services::cart();
            if (empty($rowid)) {
                return redirect()->to('/bag/checkout');
            }

            $items = $bag->contents();
            if (!isset($items[$rowid])) {
                return redirect()->to('/bag/checkout');
            }

            $currentQty = (int) $items[$rowid]['qty'];
            $newQty = $currentQty - 1;

            if ($newQty <= 0) {
                $bag->remove($rowid);
            } else {
                $bag->update([
                    'rowid' => $rowid,
                    'qty'   => $newQty,
                ]);
            }

            return redirect()->to('/bag/checkout');
        }

        public function deleteItem(string $rowid = null) {
            $bag = \Config\Services::cart();
            if (empty($rowid)) {
                return redirect()->to('/bag/checkout');
            }

            $items = $bag->contents();
            if (!isset($items[$rowid])) {
                return redirect()->to('/bag/checkout');
            }

            $bag->remove($rowid);
            return redirect()->to('/bag/checkout');
        }
}