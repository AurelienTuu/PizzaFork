<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['text' => 'Pâte à Pizza',       'picture' => 'patePizza_1.jpg'],
            ['text' => 'Sauce Tomate',      'picture' => 'sauceTomate_1.jpg'],
            ['text' => 'Mozarella',         'picture' => 'Mozarella.jpg'],
            ['text' => 'Poivrons',          'picture' => 'poivrons_1.jpg'],
            ['text' => 'Olives Noires',     'picture' => 'olives.jpeg'],
            ['text' => 'Oignons',           'picture' => 'oignons.jpg'],
            ['text' => 'basilic',           'picture' => 'basilic.jpg'],
            ['text' => 'Parmesan',          'picture' => 'parmesan.jpg'],
            ['text' => 'huile d\'olives',   'picture' => 'huile_olives.jpg'],
            ['text' => 'Fromage de Chèvre', 'picture' => 'fromageChevre.jpg'],
            ['text' => 'Miel',              'picture' => 'miel.jpg'],
            ['text' => 'Crème Fraiche',     'picture' => 'cremeFraiche.jpg'],
            ['text' => 'Jambon',            'picture' => 'jambon.jpg'],
            ['text' => 'Champignons',       'picture' => 'champignons.jpg'],
            ['text' => 'Viande Hachée',     'picture' => 'viandeHachée.jpg'],
            ['text' => 'Lardons',           'picture' => 'lardon.jpg'],
            ['text' => 'Oeuf',              'picture' => 'oeuf_1.jpg'],
            ['text' => 'Chorizo',           'picture' => 'chorizo.jpg'],
            ['text' => 'Reblochon',         'picture' => 'reblochon.jpg'],
            ['text' => 'Pommes de terre',   'picture' => 'pommeDeTerre.jpg'],
            ['text' => 'Saumon fumé',       'picture' => 'saumon.jpg'],
            ['text' => 'Bleu',              'picture' => 'bleu.jpeg'],
            ['text' => 'Emmental',          'picture' => 'emmental.jpg'],
            ['text' => 'Ananas',            'picture' => 'ananas.jpg'],
            ['text' => 'Raclette',          'picture' => 'fromageRaclette.jpg'],
            ['text' => 'Thon',              'picture' => 'thon.jpeg'],
            ['text' => 'Jalapeños',         'picture' => 'Jalapenos.png'],
            ['text' => 'Concombre',         'picture' => 'concombre.jpg'],
            ['text' => 'Poulet',            'picture' => 'poulet.jpg'],
        ];

        $this->db->table('ingredient')->insertBatch($data);
    }
}