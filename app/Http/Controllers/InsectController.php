<?php

namespace App\Http\Controllers;

use App\Models\Insect;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsectRequest;
use App\Http\Requests\UpdateInsectRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Request;

class InsectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with([
            'families' => function ($query) {
                $query->orderBy('name', 'asc')
                    ->with([
                        'insects' => function ($q) {
                            $q->orderBy('scientific_name', 'asc');
                        }
                    ]);
            }
        ])
            ->orderBy('name', 'asc')
            ->get();

        return view('insectary.index', compact('orders'));
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
    public function show(int $id)
    {
        $insect = Insect::with(['family', 'order', 'common_names', 'cultures', 'images'])
            ->findOrFail($id);

        return view('insectary.detail', compact('insect'));
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
