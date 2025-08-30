<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCultureRequest;
use App\Http\Requests\UpdateCultureRequest;

class CultureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cultures = Culture::all();
        return view('admin.cultures.index', compact('cultures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cultures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCultureRequest $request)
    {
        $request->validated();

        Culture::create($request->all());

        return redirect()->route('admin.cultures.index')->with('success', 'Culture created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Culture $culture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Culture $culture)
    {
        return view('admin.cultures.edit', compact('culture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCultureRequest $request, Culture $culture)
    {
        $request->validated();

        $culture->update($request->all());

        return redirect()->route('admin.cultures.index')->with('success', 'Culture updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Culture $culture)
    {
        $culture->delete();

        return redirect()->route('admin.cultures.index')->with('success', 'Culture deleted successfully.');
    }
}
