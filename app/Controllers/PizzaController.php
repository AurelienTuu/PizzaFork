<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PizzaModel;
use App\Entities\Pizza;
use App\Models\IngredientModel;


class PizzaController extends BaseController {
    /** @var PizzaModel $pizzaModel */
    protected $pizzaModel;
    protected $ingredientModel;

    public function __construct() {
        $this->helpers = ['form', 'url'];
        $this->pizzaModel = new PizzaModel();
        $this->ingredientModel = new IngredientModel();
    }

    public function index() {
        $data['pizzas'] = $this->pizzaModel->getAll();
        $data['title'] = "Les pizzas";
        $data['pager'] = $this->pizzaModel->pager;
        return view('Pizza-index.php', $data);
    }

    public function details(int $id) {
    $data['pizza'] = $this->pizzaModel->getById($id);
    $data['ingredients'] = $this->ingredientModel->findAll(); 
    
    $data['title'] = "Détails de la pizza";
    
    return view('Pizza-detail.php', $data);
}

    public function create() {
        $data['title'] = 'Nouvelle Pizza';
        return view('Pizza-form.php', $data);
    }

    public function delete(int $id) {
        $this->pizzaModel->delete($id);
        return redirect()->to('/pizzas')->with('message', 'Pizza supprimée');
    }

    public function save(int $id = null) {
        $rules = $this->pizzaModel->getValidationRules();
        $file = $this->request->getFile('picture');
        $isNewUpload = $file && $file->getError() !== UPLOAD_ERR_NO_FILE;

        if (is_null($id) || $isNewUpload) {
            $rules['picture'] = [
                'uploaded[picture]',
                'mime_in[picture,image/jpg,image/jpeg,image/png]',
                'max_size[picture,2048]',
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            $img = $this->request->getFile('picture');
            $form_data = [
                'text' => $this->request->getPost('text'),
            ];

            if ($img && $img->isValid() && $img->getError() !== UPLOAD_ERR_NO_FILE) {
                $img->move('img');
                $form_data['picture'] = $img->getName();
            }
            if (!is_null($id)) {
                $form_data['id'] = $id;
            }
            $pizza = new Pizza($form_data);
            $this->pizzaModel->save($pizza);
            return redirect()->to('/pizzas')->with('message', 'Pizza sauvegardée');
        }
    }

    public function edit(int $id) {
        $data['title'] = "Modifier pizza";
        $data['pizza'] = $this->pizzaModel->find($id);
        return view('Pizza-form.php', $data);
    }
}
