<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ModelType;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = [
            [ 'name' => 'iPhone SE', 'capacity' => '2GB/16GB', 'type_id' => 1, 'brand_id' => 1 ],
            [ 'name' => 'iPhone SE (2020)', 'capacity' => '3GB/64GB', 'type_id' => 1, 'brand_id' => 1],
            [ 'name' => 'iPhone SE', 'capacity' => '2GB/32GB', 'type_id' => 1, 'brand_id' => 1 ],
        ];

        ModelType::insert($model);
    }
}
