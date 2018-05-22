<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Resources\Branch as BranchResource;
use App\Http\Resources\Product as ProductResource;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $request->validate([
            'address' => ['required'],
            'city_id' => ['required', 'numeric'],
            'is_active' => ['required', 'numeric'],
        ]);
        $branch = new Branch();
        $storedBranch = $branch->create($request->all());
        return new BranchResource($storedBranch);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new BranchResource(Branch::findOrFail($id));
    }
    
    /**
     * Display related resources for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProducts($id) {
        return ProductResource::collection(Branch::findOrFail($id)->product);
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
            'address' => ['required'],
            'city_id' => ['required', 'numeric'],
            'is_active' => ['required', 'numeric'],
        ]);
        $branch = Branch::findOrFail($id);
        $branch->update($request->all());
        return new BranchResource($branch);
    }
}
