<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GarnitureModel;
use App\Entities\Garniture;
use App\Models\IngredientModel;
use App\Models\PizzaModel;

class GarnitureController extends BaseController
{
    /** @var GarnitureModel $garnitureModel */
    protected $garnitureModel;
    protected $pizzaModel;

    public function __construct()
    {
        $this->helpers = ['form', 'url'];
        $this->garnitureModel = new GarnitureModel();
        $this->pizzaModel = new PizzaModel();
    }

    public function index($idPizza)
    {
        $data['pizza'] = $this->pizzaModel->getById($idPizza);
        $data['title'] = "Les garnitures";
        return view('Garniture-index.php', $data);
    }

    public function create(int $idPizza)
    {
        $ingredientModel = new IngredientModel();
        $data['idPizza'] = $idPizza;
        $data['title'] = 'Nouvelle Garniture';
        $data['ingredients'] = $ingredientModel->findAll();
        return view('Garniture-form.php', $data);
    }

    public function delete(int $id)
    {
        $garniture = $this->garnitureModel->find($id);

        $idPizza = $garniture->idPizza;
        $idIngredient = $garniture->idIngredient;

        $cfg = config('PizzaFork');
        $idPate = $cfg->idPateAPizza ?? $cfg->idPateAPain ?? null;
        
        if (!is_null($idPate) && $idIngredient == $idPate) {
            return redirect()->to('/pizza/ingredients/' . $idPizza)->with('error', 'Impossible de supprimer la pâte à pizza.');
        }

        $this->garnitureModel->delete($id);

        return redirect()->to('/pizza/ingredients/' . $idPizza)->with('message', 'Garniture supprimée avec succès.');
    }


    public function save(int $id = null)
    {
        $rules = $this->garnitureModel->getValidationRules();
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            $idPizza = $this->request->getPost('idPizza');
            $form_data = [
                'idPizza' => $idPizza,
                'idIngredient' => $this->request->getPost('idIngredient'),
                'quantity' => $this->request->getPost('quantity'),
                'order' => $this->request->getPost('order'),
            ];
            if (!is_null($id)) {
                $form_data['id'] = $id;
            }
            $garniture = new Garniture($form_data);
            $this->garnitureModel->save($garniture);
            return redirect()->to('/pizza/ingredients/' . $idPizza)->with('message', 'Garniture enregistrée');
        }
    }

    public function edit(int $id)
    {
        $ingredientModel = new IngredientModel();
        $data['title'] = 'Modifier une garniture';
        $data['garniture'] = $this->garnitureModel->getById($id);
        $data['ingredients'] = $ingredientModel->findAll();
        return view('Garniture-form.php', $data);
    }
}
