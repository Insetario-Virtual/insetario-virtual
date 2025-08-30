<?php

namespace App\Http\Controllers;

use App\Models\SiteContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siteContents = SiteContent::all();
        return view('admin.site-data.index', compact('siteContents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.site-data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'string',
        ]);

        SiteContent::create($request->only('title', 'description'));

        return redirect()->route('admin.site-data.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SiteContent $siteContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $siteData = SiteContent::findOrFail($id);
        
        return view('admin.site-data.edit', compact('siteData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SiteContent $siteData)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'string',
        ]);

        $siteData->update($request->only('title', 'description'));

        return redirect()->route('admin.site-data.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiteContent $siteData)
    {
        $siteData->delete();

        return redirect()->route('admin.site-data.index');
    }
}
