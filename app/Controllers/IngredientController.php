<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IngredientModel;
use App\Models\GarnitureModel;
use App\Entities\Ingredient;

class IngredientController extends BaseController
{
    /** @var IngredientModel $ingredientModel */
    protected $ingredientModel;
    /** @var GarnitureModel $garnitureModel */
    protected $garnitureModel;

    public function __construct()
    {
        $this->helpers = ['form', 'url'];
        $this->ingredientModel = new IngredientModel();
        $this->garnitureModel = new GarnitureModel();
    }

    public function index()
    {
        $ingredients = $this->ingredientModel->orderBy('id')->findAll();
        $data['ingredients'] = $ingredients;
        $data['title'] = "Les ingredients";
        return view('Ingredient-index.php', $data);
    }

    public function create()
    {
        $data['title'] = 'Nouvel Ingredient';
        return view('Ingredient-form.php', $data);
    }

    public function delete(int $id)
    {
        $isUsed = $this->garnitureModel->where('idIngredient', $id)->first();

        if ($isUsed) {
            return redirect()->to('/ingredients')->with('error', 'Impossible de supprimer : cet ingrédient est utilisé dans une ou plusieurs pizzas.');
        }

        $this->ingredientModel->where(['id' => $id])->delete();

        return redirect()->to('/ingredients')->with('message', 'Ingrédient supprimé avec succès.');
    }

    public function save(int $id = null)
    {
        $rules = $this->ingredientModel->getValidationRules();

        $rules['picture'] = [
            'uploaded[picture]',
            'mime_in[picture,image/jpg,image/jpeg,image/png]',
            'max_size[picture,1024]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with(
                'errors',
                $this->validator->getErrors()
            );
        } else {
            $img = $this->request->getFile('picture');

            $img->move('img');

            $form_data = [
                'text' => $this->request->getPost('text'),
                'picture' => $img->getName(),
            ];

            if (!is_null($id)) {
                $form_data['id'] = $id;
            }

            $ingredient = new Ingredient($form_data);
            $this->ingredientModel->save($ingredient);

            return redirect()->to('/ingredients')->with(
                'message',
                'Ingrédient sauvegardé'
            );
        }
    }

    public function edit(int $id)
    {
        $data['title'] = "Modifier ingredient";
        $data['ingredient'] = $this->ingredientModel->find($id);
        return view('Ingredient-form.php', $data);
    }
}
