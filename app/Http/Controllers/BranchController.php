<?php

namespace App\Http\Controllers;

use App\Branch;
use App\UserAction;
use Illuminate\Http\Request;
use App\Http\Resources\Branch as BranchResource;
use \App\Http\Traits\UserRolesTrait;

class BranchController extends Controller
{
    use UserRolesTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userAction = UserAction::where('name', 'branch.showAll')->first();
        $this->checkActionPermission($request->user()->role->name, $userAction->roles);
        return BranchResource::collection(Branch::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userAction = UserAction::where('name', 'branch.store')->first();
        $this->checkActionPermission($request->user()->role->name, $userAction->roles);
        $request->validate([
            'address' => 'required',
            'city_id' => 'required|numeric',
            'is_active' => 'required|numeric',
        ]);
        $branch = new Branch();
        $storedBranch = $branch->create($request->all());
        return response()->json($storedBranch, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $userAction = UserAction::where('name', 'branch.showOne')->first();
        $this->checkActionPermission($request->user()->role->name, $userAction->roles);
        return new BranchResource(Branch::findOrFail($id));
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
        $userAction = UserAction::where('name', 'branch.update')->first();
        $this->checkActionPermission($request->user()->role->name, $userAction->roles);
        $request->validate([
            'address' => 'required',
            'city_id' => 'required|numeric',
            'is_active' => 'required|numeric',
        ]);
        $branch = Branch::findOrFail($id);
        $branch->update($request->all());
        return response()->json($branch, 200);
    }
}
