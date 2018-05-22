<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Order as OrderResource;

class UserController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }
    
    /**
     * Display related resources for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOrders($id) {
        return OrderResource::collection(User::findOrFail($id)->order);
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
            'name' => 'min:3|regex:/^[a-zA-Z\-\s]+$/',
            'email' => 'email',
            'password' => 'min:6',
            'phone' => 'regex:/^[0-9]{12}+$/',
            'role_id' => 'numeric',
            'is_active' => 'numeric',
        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return new UserResource($user);
    }
}
