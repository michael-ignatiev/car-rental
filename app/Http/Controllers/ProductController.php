<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use App\UserAction;
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
    public function index(Request $request)
    {
        $userAction = UserAction::where('name', 'product.showAll')->first();
        $this->checkActionPermission($request->user()->role->name, $userAction->roles);
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
        $userAction = UserAction::where('name', 'product.store')->first();
        $this->checkActionPermission($request->user()->role->name, $userAction->roles);
        $request->validate([
            'model' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'branch_id' => ['required', 'numeric'],
            'price_per_hour' => ['required', 'regex:/^[0-9\.]+$/'],
            'product_type_id' => ['required', 'numeric'],
            'is_active' => ['required', 'numeric'],
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
    public function show(Request $request, $id)
    {
        $userAction = UserAction::where('name', 'product.showOne')->first();
        $this->checkActionPermission($request->user()->role->name, $userAction->roles);
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
        $userAction = UserAction::where('name', 'product.update')->first();
        $this->checkActionPermission($request->user()->role->name, $userAction->roles);
        $request->validate([
            'model' => ['regex:/^[a-zA-Z0-9\s]+$/'],
            'branch_id' => ['numeric'],
            'price_per_hour' => ['regex:/^[0-9\.]+$/'],
            'product_type_id' => ['numeric'],
            'is_active' => ['numeric'],
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
        $userAction = UserAction::where('name', 'product.delete')->first();
        $this->checkActionPermission($request->user()->role->name, $userAction->roles);
        Product::findOrFail($id)->delete();
        return response()->json([], 204);
    }
}
