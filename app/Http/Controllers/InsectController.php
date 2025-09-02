<?php

namespace App\Http\Controllers;

use App\Models\Insect;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsectRequest;
use App\Http\Requests\UpdateInsectRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class InsectController extends Controller
{
    private function getOrganizedData()
    {
        return Order::with([
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
    }
    /**
     * Display a listing of the resource.
     */
    public function indexPublic()
    {
        $orders = $this->getOrganizedData();
        return view('insectary.public.index', compact('orders'));
    }

    public function indexAdmin()
    {
        $orders = $this->getOrganizedData();
        return view('admin.insectary.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::with('families')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.insectary.create', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInsectRequest $request)
    {
        DB::transaction(function () use ($request) {
            // Create the insect
            $insect = Insect::create($request->validated());

            // Store common names
            if ($request->has('common_names')) {
                $insect->commonNames()->createMany(
                    collect($request->input('common_names'))
                        ->filter(fn($name) => !empty($name))
                        ->map(fn($name) => ['name' => $name])
                        ->toArray()
                );
            }

            // Store cultures
            if ($request->has('cultures')) {
                $insect->cultures()->sync($request->input('cultures'));
            }

            // Store images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('insects', 'public');
                    $insect->images()->create(['path' => $path]);
                }
            }
        });

        return redirect()->route('admin.insects.index')
            ->with('success', 'Insect created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $insect = Insect::with(['family', 'order', 'commonNames', 'cultures', 'images'])
            ->findOrFail($id);

        return view('insectary.detail', compact('insect'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insect $insect)
    {
        return view('admin.families.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInsectRequest $request, Insect $insect)
    {
        DB::transaction(function () use ($request, $insect) {
            // Update insect main data
            $insect->update($request->validated());

            // Update common names
            $insect->commonNames()->delete();
            if ($request->has('common_names')) {
                $insect->commonNames()->createMany(
                    collect($request->input('common_names'))
                        ->filter(fn($name) => !empty($name))
                        ->map(fn($name) => ['name' => $name])
                        ->toArray()
                );
            }

            // Update cultures
            $insect->cultures()->sync($request->input('cultures', []));

            // Add new images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('insects', 'public');
                    $insect->images()->create(['path' => $path]);
                }
            }
        });

        return redirect()->route('admin.insects.index')
            ->with('success', 'Insect updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $insect = Insect::findOrFail($id);

        $insect->delete();

        return redirect()->route('admin.insectary.index');
    }
}
