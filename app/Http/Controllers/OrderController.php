<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Order as OrderResource;
use App\Rules\Price;
use App\Rules\Discount;
use App\Rules\Total;

class OrderController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
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
            'user_id' => ['required', 'numeric'],
            'product_id' => ['required', 'numeric'],
            'branch_to_take_from_id' => ['required', 'numeric'],
            'rental_plan_id' => ['required', 'numeric'],
            'payment_type_id' => ['required', 'numeric'],
            'payment_status_id' => ['required', 'numeric'],
            'price' => ['required', 'regex:/^[0-9\.]+$/', new Price($request->all())],
            'discount_id' => ['numeric', new Discount()],
            'total' => ['required', 'regex:/^[0-9\.]+$/', new Total($request->all())],
            'comment' => ['required', 'between:3,1000'],
        ]);
        $order = new Order();
        $storedOrder = $order->create($request->all());
        return new OrderResource($storedOrder);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        return new OrderResource(Order::findOrFail($id));
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
            'user_id' => ['required', 'numeric'],
            'product_id' => ['required', 'numeric'],
            'branch_to_take_from_id' => ['numeric'],
            'branch_to_return_to_id' => ['required', 'numeric'],
            'rental_plan_id' => ['numeric'],
            'payment_type_id' => ['numeric'],
            'payment_status_id' => ['numeric'],
            'price' => 'regex:/^[0-9\.]+$/',
            'discount_id' => ['numeric'],
            'total' => ['regex:/^[0-9\.]+$/'],
            'comment' => ['between:3,1000'],
        ]);
        $order = Order::findOrFail($id);
        $order->update($request->all());   
        $product = Product::findOrFail($request->product_id);
        $product->update(['branch_id' => $request->branch_to_return_to_id]);
        return new OrderResource($order);
    }
}
