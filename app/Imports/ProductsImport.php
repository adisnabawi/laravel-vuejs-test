<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\ModelType;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            \Log::info($row);
            $product = Product::find($row['product_id']);
            if ($product) {
                if ($row['status'] == 'Sold') {
                    $product->decrement('quantity', 1);
                } else if ($row['status'] == 'Buy'){
                    $product->increment('quantity', 1);
                }
                $product->save();  
            } else {
                if  ($row['status'] == 'Buy') {
                    continue;
                }
                $type = Type::firstOrCreate(
                    ['name' => $row['types']]
                );

                $brand = Brand::firstOrCreate(
                    ['name' => $row['brand']]
                );

                $modeltype = ModelType::firstOrCreate(
                    ['name' => $row['model'], 'capacity' => $row['capacity']],
                    ['type_id' => $type->id, 'brand_id' => $brand->id]
                );

                $product = new Product;
                $product->id = $row['product_id'];
                $product->quantity = 1;
                $product->type_id = $type->id;
                $product->brand_id = $brand->id;
                $product->model_type_id = $modeltype->id;
                $product->save();
            }
        }
    }
}
