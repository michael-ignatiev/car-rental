<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;
use \App\Http\Traits\UserRolesTrait;

class ProductController extends Controller
{ 
    use UserRolesTrait;
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
        $this->allowActionForRoles($request->user()->role->name, ['admin']);
        $request->validate([
            'model' => 'required',
            'branch_id' => 'required|numeric',
            'price_per_hour' => 'required',
            'product_type_id' => 'required|numeric',
            'is_active' => 'required|numeric',
        ]);
        $product = new Product();
        $storedProduct = $product->create($request->all());
        return response()->json($storedProduct, 201);
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
        $this->allowActionForRoles($request->user()->role->name, ['admin']);
        $request->validate([
            'model' => 'required',
            'branch_id' => 'required|numeric',
            'price_per_hour' => 'required',
            'product_type_id' => 'required|numeric',
            'is_active' => 'required|numeric',
        ]);
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->allowActionForRoles($request, ['admin']);
        Product::findOrFail($id)->delete();
        return response()->json([], 204);
    }
}
