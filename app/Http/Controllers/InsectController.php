<?php

namespace App\Http\Controllers;

use App\Models\Insect;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsectRequest;
use App\Http\Requests\UpdateInsectRequest;
use App\Models\Order;

class InsectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with([
            'families' => function ($query) {
                $query->orderBy('nome_familia', 'asc')
                    ->with(['insects' => function ($q) {
                        $q->orderBy('nome_cientifico', 'asc');
                    }]);
            }
        ])
            ->orderBy('nome_ordem', 'asc')
            ->get();

        dd($orders);
        return view('insects.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInsectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Insect $insect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insect $insect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInsectRequest $request, Insect $insect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insect $insect)
    {
        //
    }
}
