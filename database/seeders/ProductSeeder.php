<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['quantity' => 30, 'type_id' => 1, 'brand_id' => 1, 'model_type_id' => 1],
            ['quantity' => 20, 'type_id' => 1, 'brand_id' => 1, 'model_type_id' => 2],
            ['id' => 4768, 'quantity' => 10, 'type_id' => 1, 'brand_id' => 1, 'model_type_id' => 3]
        ];

        Product::insert($products);
    }
}
