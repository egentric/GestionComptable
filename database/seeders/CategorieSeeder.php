<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::Create([        
            'categoryName' => 'Paiement Client',
        ]);
        Categories::Create([        
            'categoryName' => 'Assurances',
        ]);
        Categories::Create([        
            'categoryName' => 'Loyers',
        ]);
        Categories::Create([        
            'categoryName' => 'Carburants',
        ]);
        Categories::Create([        
            'categoryName' => 'Salaires',
        ]);

    }
}
