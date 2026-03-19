<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PizzaModel;

class HomeController extends BaseController{
    public function index(){
        $pizzaModel = new PizzaModel();
        $data['title'] = 'Commandez vos pizzas';
        $data['pizzas'] = $pizzaModel->getAll();
        $data['pager'] = $pizzaModel->pager;
        return view('Home.php', $data);
    }
}
