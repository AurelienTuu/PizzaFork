<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PizzaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['text' => 'Chèvre Miel',   'picture' => 'chevreMiel.jpg'],
            ['text' => 'Fermière',     'picture' => 'fermiere.png'],
            ['text' => 'Margherita',   'picture' => 'margherita.jpg'],
            ['text' => 'Orientale',    'picture' => 'orientale.png'],
            ['text' => 'Regina',       'picture' => 'regina.jpg'],
            ['text' => 'Hawaïenne',    'picture' => 'hawaienne.jpg'],
            ['text' => 'Vegetarienne', 'picture' => 'vegetarienne.jpg'],
            ['text' => '4 Fromages',   'picture' => '4Fromages.jpg'],
            ['text' => 'Bolognaise',   'picture' => 'bolognaise.jpeg'],
            ['text' => 'Calzone',      'picture' => 'calzone.jpg'],
            ['text' => 'Tartiflette',  'picture' => 'tartiflette.jpg'],
            ['text' => 'Raclette',     'picture' => 'raclette.jpg'],
            ['text' => 'Mexicaine',    'picture' => 'mexicaine.jpeg'],
            ['text' => 'Forestière',   'picture' => 'forestiere.jpg'],
            ['text' => 'Pêcheur',      'picture' => 'pecheur.jpg'],
            ['text' => 'Norvegienne',  'picture' => 'norvegienne.jpg'],
        ];

        $this->db->table('pizza')->insertBatch($data);
    }
}