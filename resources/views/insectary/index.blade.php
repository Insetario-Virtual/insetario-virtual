@extends('layouts.app')

@vite(['resources/js/filterForm.js'])

@section('content')

<div class="pb-4 w-full h-fit px-10 max-sm:px-4 bg-fixed bg-no-repeat bg-cover bg-center">

    <x-filter-form :orders="$orders" :families="$families" :cultures="$cultures" />

    <div class=" w-full h-fit rounded px-4 py-3 mt-4 z-10">
        @foreach($organized as $order)
        <section class="mt-6">
            <h2 class="text-2xl font-semibold text-white">{{ $order['name'] }}</h2>

            @foreach($order['families'] as $family)
            <div class="mt-4">
                <h3 class="text-xl font-semibold text-white pl-4">{{ $family['name'] }}</h3>

                <div class="flex flex-wrap gap-4 mt-3">
                    @foreach($family['insects'] as $insect)
                    @php

                    $isEloquentModel = $insect instanceof \App\Models\Insect;

                    $id = $isEloquentModel ? $insect->id : ($insect['id'] ?? null);
                    $commonName = $isEloquentModel
                    ? ($insect->commonNames->first()->name ?? null)
                    : ($insect['common_name'] ?? null);

                    $scientificName = $isEloquentModel ? $insect->scientific_name : ($insect['scientific_name'] ?? null);

                    $imagePathRaw = $isEloquentModel ? $insect->image_path : ($insect['image_path'] ?? null);

                    $imagePath = $imagePathRaw;
                    if (!$isEloquentModel && $imagePathRaw && !str_starts_with($imagePathRaw, '/storage/insect_images/')) {
                    $imagePath = '/storage/' . $imagePathRaw;
                    }

                    @endphp

                    <a href="{{ route('insetario.show', ['id' => $id]) }}"
                        class="flex md:flex-col rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">

                        <div class="h-full w-40 md:h-40 md:w-full bg-gray-100 overflow-hidden flex-shrink-0">
                            <img
                                src="{{ asset($imagePath) }}"
                                alt="{{ $scientificName }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="p-4 flex flex-col items-start justify-center w-full md:items-center md:w-full">
                            <h3 class="text-lg font-semibold text-gray-100 capitalize">{{ $commonName }}</h3>
                            <p class="text-md text-gray-400 italic capitalize">{{ $scientificName }}</p>
                        </div>
                    </a>

                    {{-- Se quiser voltar a usar o componente, descomente abaixo --}}
                    {{--
                    <x-insect-card
                        :id="$id"
                        :common_name="$commonName"
                        :scientific_name="$scientificName"
                        :image_path="$imagePath" />
                    --}}
                    @endforeach
                </div>
            </div>
            @endforeach

        </section>
        @endforeach
    </div>
</div>
@endsection