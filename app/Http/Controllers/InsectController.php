<?php

namespace App\Http\Controllers;

use App\Models\Insect;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsectRequest;
use App\Http\Requests\UpdateInsectRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsectController extends Controller
{
    private function getOrganizedData()
    {
        return Order::with(['families' => function ($query) {
            $query->orderBy('name', 'asc')->with(['insects' => function ($q) {
                $q->orderBy('scientific_name', 'asc');
            }]);
        }])->orderBy('name', 'asc')->get();
    }
    private function getOrganizedData2(array $filters = [])
    {
        $query = DB::table('insects')
            ->select(
                'insects.id',
                'insects.scientific_name',
                'insects.order_id',
                'insects.family_id',
                'insects.predator',
                'orders.name as order_name',
                'families.name as family_name',
                DB::raw('GROUP_CONCAT(DISTINCT common_names.name SEPARATOR ", ") as common_names')
            )
            ->join('orders', 'insects.order_id', '=', 'orders.id')
            ->join('families', 'insects.family_id', '=', 'families.id')
            ->leftJoin('common_names', 'insects.id', '=', 'common_names.insect_id')
            ->leftJoin('insect_culture', 'insects.id', '=', 'insect_culture.insect_id')
            ->leftJoin('cultures', 'insect_culture.culture_id', '=', 'cultures.id')
            ->groupBy(
                'insects.id',
                'insects.scientific_name',
                'insects.order_id',
                'insects.family_id',
                'insects.predator',
                'orders.name',
                'families.name'
            );

        // Filtros
        if (!empty($filters['scientific_name'])) {
            $query->where('insects.scientific_name', 'like', '%' . $filters['scientific_name'] . '%');
        }

        if (!empty($filters['order'])) {
            $query->where('orders.id', $filters['order']);
        }

        if (!empty($filters['family'])) {
            $query->where('families.id', $filters['family']);
        }

        if (!empty($filters['predator'])) {
            $query->where('insects.predator', $filters['predator']);
        }

        if (!empty($filters['common_name'])) {
            $query->where('common_names.name', 'like', '%' . $filters['common_name'] . '%');
        }

        if (!empty($filters['culture'])) {
            $query->where('cultures.id', $filters['culture']);
        }



        // $results = $query->orderBy('orders.name')
        //     ->orderBy('families.name')
        //     ->orderBy('insects.scientific_name')
        //     ->get();

        $results = $query->get();




        // 🔹 Reorganizar no formato (ordens → famílias → insetos)
        $orders = [];


        foreach ($results as $row) {
            $orderId = $row->order_id;
            $familyId = $row->family_id;

            if (!isset($orders[$orderId])) {
                $orders[$orderId] = [
                    'id' => $orderId,
                    'name' => $row->order_name,
                    'families' => [],
                ];
            }

            if (!isset($orders[$orderId]['families'][$familyId])) {
                $orders[$orderId]['families'][$familyId] = [
                    'id' => $familyId,
                    'name' => $row->family_name,
                    'insects' => [],
                ];
            }

            $orders[$orderId]['families'][$familyId]['insects'][] = [
                'id' => $row->id,
                'common_name' => $row->common_names,
                'scientific_name' => $row->scientific_name,
            ];
        }

        return $orders;
    }

    /**
     * Display a listing of the resource.
     */
    public function indexPublic(Request $request)
    {
        $filters = $request->only([
            'common_name',
            'scientific_name',
            'order',
            'family',
            'predator',
            'culture',
        ]);


        $organized = (!sizeof($filters)) ?  $this->getOrganizedData() : $this->getOrganizedData2($filters);


        return view('insectary.index', compact('organized'));
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
    public function edit(int $id)
    {
        $insect = Insect::findOrFail($id);

        return view('admin.insectary.edit');
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
