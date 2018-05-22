<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'model' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'branch_id' => ['required', 'numeric'],
            'price_per_hour' => ['required', 'regex:/^[0-9\.]+$/'],
            'product_type_id' => ['required', 'numeric'],
            'is_active' => ['required', 'numeric'],
        ]);
        $product = new Product();
        $storedProduct = $product->create($request->all());
        return new ProductResource($storedProduct);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ProductResource(Product::findOrFail($id));
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
        $request->validate([
            'model' => ['regex:/^[a-zA-Z0-9\s]+$/'],
            'branch_id' => ['numeric'],
            'price_per_hour' => ['regex:/^[0-9\.]+$/'],
            'product_type_id' => ['numeric'],
            'is_active' => ['numeric'],
        ]);
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json([], 204);
    }
}
