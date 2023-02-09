<?php

namespace App\Imports;

use App\Models\Product;
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
            }
        }
    }
}
