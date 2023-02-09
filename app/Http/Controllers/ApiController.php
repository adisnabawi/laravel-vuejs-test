<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Excel;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if (isset($request->q)) {
            // get products by search where has model types name, brand name, type name and get all the values
            $products = Product::whereHas('modeltype', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%');
            })->orWhereHas('brand', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%');
            })->orWhereHas('type', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%');
            })->orWhereHas('modeltype', function ($query) use ($request) {
                $query->where('capacity', 'like', '%' . $request->q . '%');
            })->get();
        } else {
            $products = Product::get();
        }
        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->id,
                'quantity' => $product->quantity,
                'type' => $product->type->name,
                'brand' => $product->brand->name,
                'capacity' => $product->modeltype->capacity,
                'model' => $product->modeltype->name,
            ];
        }

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);
        
        try {
            Excel::import(new ProductsImport, request()->file('file'));
            return response()->json(['status_code' => 200, 'message' => 'Data Imported successfully.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['status_code' => 500, 'message' => 'Data Imported failed.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
