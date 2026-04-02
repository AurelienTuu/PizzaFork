<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GarnitureSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // --- PIZZA 1 : CHÈVRE MIEL ---
            ['idPizza' => 1, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],   // Pâte
            ['idPizza' => 1, 'idIngredient' => 12, 'order' => 20, 'quantity' => 100], // Crème Fraiche
            ['idPizza' => 1, 'idIngredient' => 10, 'order' => 30, 'quantity' => 10],  // Chèvre
            ['idPizza' => 1, 'idIngredient' => 3,  'order' => 40, 'quantity' => 100], // Mozarella
            ['idPizza' => 1, 'idIngredient' => 11, 'order' => 50, 'quantity' => 50],  // Miel

            // --- PIZZA 2 : FERMIÈRE ---
            ['idPizza' => 2, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 2, 'idIngredient' => 12, 'order' => 20, 'quantity' => 100],
            ['idPizza' => 2, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 2, 'idIngredient' => 29, 'order' => 40, 'quantity' => 50],  // Poulet
            ['idPizza' => 2, 'idIngredient' => 20, 'order' => 50, 'quantity' => 40],  // Pomme de terre

            // --- PIZZA 3 : MARGHERITA ---
            ['idPizza' => 3, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 3, 'idIngredient' => 2,  'order' => 20, 'quantity' => 100],
            ['idPizza' => 3, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 3, 'idIngredient' => 7,  'order' => 40, 'quantity' => 5],
            ['idPizza' => 3, 'idIngredient' => 9,  'order' => 50, 'quantity' => 20],

            // --- PIZZA 4 : ORIENTALE ---
            ['idPizza' => 4, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 4, 'idIngredient' => 2,  'order' => 20, 'quantity' => 100],
            ['idPizza' => 4, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 4, 'idIngredient' => 4,  'order' => 40, 'quantity' => 20],  // Poivrons
            ['idPizza' => 4, 'idIngredient' => 6,  'order' => 50, 'quantity' => 20],  // Oignons
            ['idPizza' => 4, 'idIngredient' => 18, 'order' => 60, 'quantity' => 60],  // Chorizo
            ['idPizza' => 4, 'idIngredient' => 17, 'order' => 70, 'quantity' => 1],   // Oeuf

            // --- PIZZA 5 : REGINA ---
            ['idPizza' => 5, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 5, 'idIngredient' => 2,  'order' => 20, 'quantity' => 100],
            ['idPizza' => 5, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 5, 'idIngredient' => 13, 'order' => 40, 'quantity' => 50],  // Jambon
            ['idPizza' => 5, 'idIngredient' => 14, 'order' => 50, 'quantity' => 30],  // Champignons
            ['idPizza' => 5, 'idIngredient' => 5,  'order' => 60, 'quantity' => 10],  // Olives

            // --- PIZZA 6 : HAWAÏENNE ---
            ['idPizza' => 6, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 6, 'idIngredient' => 2,  'order' => 20, 'quantity' => 100],
            ['idPizza' => 6, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 6, 'idIngredient' => 13, 'order' => 40, 'quantity' => 60],
            ['idPizza' => 6, 'idIngredient' => 24, 'order' => 50, 'quantity' => 50],  // Ananas

            // --- PIZZA 7 : VEGETARIENNE ---
            ['idPizza' => 7, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 7, 'idIngredient' => 2,  'order' => 20, 'quantity' => 100],
            ['idPizza' => 7, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 7, 'idIngredient' => 28, 'order' => 40, 'quantity' => 40],  // Concombre
            ['idPizza' => 7, 'idIngredient' => 4,  'order' => 50, 'quantity' => 40],  // Poivrons
            ['idPizza' => 7, 'idIngredient' => 14, 'order' => 60, 'quantity' => 40],  // Champignons
            ['idPizza' => 7, 'idIngredient' => 6,  'order' => 70, 'quantity' => 20],  // Oignons

            // --- PIZZA 8 : 4 FROMAGES ---
            ['idPizza' => 8, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 8, 'idIngredient' => 2,  'order' => 20, 'quantity' => 100],
            ['idPizza' => 8, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 8, 'idIngredient' => 22, 'order' => 40, 'quantity' => 40],  // Bleu
            ['idPizza' => 8, 'idIngredient' => 10, 'order' => 50, 'quantity' => 40],  // Chèvre
            ['idPizza' => 8, 'idIngredient' => 23, 'order' => 60, 'quantity' => 40],  // Emmental

            // --- PIZZA 9 : BOLOGNAISE ---
            ['idPizza' => 9, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 9, 'idIngredient' => 2,  'order' => 20, 'quantity' => 100],
            ['idPizza' => 9, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 9, 'idIngredient' => 15, 'order' => 40, 'quantity' => 80],  // Viande Hachée
            ['idPizza' => 9, 'idIngredient' => 6,  'order' => 50, 'quantity' => 20],  // Oignons
            ['idPizza' => 9, 'idIngredient' => 7,  'order' => 60, 'quantity' => 10],  // Basilic

            // --- PIZZA 10 : CALZONE ---
            ['idPizza' => 10, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 10, 'idIngredient' => 2,  'order' => 20, 'quantity' => 100],
            ['idPizza' => 10, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 10, 'idIngredient' => 13, 'order' => 40, 'quantity' => 60], // Jambon
            ['idPizza' => 10, 'idIngredient' => 17, 'order' => 50, 'quantity' => 1],  // Oeuf

            // --- PIZZA 11 : TARTIFLETTE ---
            ['idPizza' => 11, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 11, 'idIngredient' => 12, 'order' => 20, 'quantity' => 100],
            ['idPizza' => 11, 'idIngredient' => 20, 'order' => 30, 'quantity' => 150],
            ['idPizza' => 11, 'idIngredient' => 16, 'order' => 40, 'quantity' => 50], // Lardons
            ['idPizza' => 11, 'idIngredient' => 19, 'order' => 50, 'quantity' => 80], // Reblochon

            // --- PIZZA 12 : RACLETTE ---
            ['idPizza' => 12, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 12, 'idIngredient' => 12, 'order' => 20, 'quantity' => 100],
            ['idPizza' => 12, 'idIngredient' => 20, 'order' => 30, 'quantity' => 150],
            ['idPizza' => 12, 'idIngredient' => 13, 'order' => 40, 'quantity' => 50],
            ['idPizza' => 12, 'idIngredient' => 25, 'order' => 50, 'quantity' => 80], // Raclette

            // --- PIZZA 13 : MEXICAINE ---
            ['idPizza' => 13, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 13, 'idIngredient' => 2,  'order' => 20, 'quantity' => 100],
            ['idPizza' => 13, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 13, 'idIngredient' => 15, 'order' => 40, 'quantity' => 80],
            ['idPizza' => 13, 'idIngredient' => 4,  'order' => 50, 'quantity' => 40],
            ['idPizza' => 13, 'idIngredient' => 6,  'order' => 60, 'quantity' => 20],
            ['idPizza' => 13, 'idIngredient' => 27, 'order' => 70, 'quantity' => 10], // Jalapenos

            // --- PIZZA 14 : FORESTIÈRE ---
            ['idPizza' => 14, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 14, 'idIngredient' => 12, 'order' => 20, 'quantity' => 100],
            ['idPizza' => 14, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 14, 'idIngredient' => 13, 'order' => 40, 'quantity' => 50],
            ['idPizza' => 14, 'idIngredient' => 14, 'order' => 50, 'quantity' => 40],

            // --- PIZZA 15 : PÊCHEUR ---
            ['idPizza' => 15, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 15, 'idIngredient' => 2,  'order' => 20, 'quantity' => 100],
            ['idPizza' => 15, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 15, 'idIngredient' => 26, 'order' => 40, 'quantity' => 100], // Thon
            ['idPizza' => 15, 'idIngredient' => 5,  'order' => 50, 'quantity' => 20],

            // --- PIZZA 16 : NORVEGIENNE ---
            ['idPizza' => 16, 'idIngredient' => 1,  'order' => 10, 'quantity' => 1],
            ['idPizza' => 16, 'idIngredient' => 12, 'order' => 20, 'quantity' => 100],
            ['idPizza' => 16, 'idIngredient' => 3,  'order' => 30, 'quantity' => 100],
            ['idPizza' => 16, 'idIngredient' => 21, 'order' => 40, 'quantity' => 60],  // Saumon
            ['idPizza' => 16, 'idIngredient' => 5,  'order' => 50, 'quantity' => 5],
        ];
        $this->db->table('garniture')->insertBatch($data);
    }
}