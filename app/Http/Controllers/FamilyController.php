<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFamilyRequest;
use App\Http\Requests\UpdateFamilyRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $families = Family::with('order')->get();
        return view('admin.families.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        
        return view('admin.families.create', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFamilyRequest $request)
    {
        $data = $request->validated();

        Family::create($data);

        return redirect()
            ->route('admin.families.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        $orders = Order::orderBy('name')->get(['id', 'name']);
        return view('admin.families.edit', compact('family', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFamilyRequest $request, Family $family)
    {
        $data = $request->validated();

        $family->update($data);

        return redirect()
            ->route('admin.families.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        $family->delete();

        return redirect()->route('admin.families.index');
    }
}
