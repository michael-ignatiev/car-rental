<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserAction;
use App\Http\Resources\User as UserResource;
use \App\Http\Traits\UserRolesTrait;

class UserController extends Controller
{
    use UserRolesTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userAction = UserAction::where('name', 'user.showAll')->first();
        $this->checkActionPermission($request->user()->role->name, $userAction->roles);
        return UserResource::collection(User::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $userAction = UserAction::where('name', 'user.showOne')->first();
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
        $userAction = UserAction::where('name', 'user.update')->first();
        $this->checkActionPermission($request->user()->role->name, $userAction->roles);
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
        return response()->json($user, 200);
    }
}
