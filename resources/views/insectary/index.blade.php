@extends('layouts.app')

@vite(['resources/js/filterForm.js'])

@section('content')


<div class="pb-4 w-full h-fit px-10 max-sm:px-4 bg-fixed bg-no-repeat bg-cover bg-center">

    <!-- Fomrulário para Filtragem -->
    <x-filter-form :orders="$orders" :families="$families" :cultures="$cultures" />

    <!-- Card com todos os Insetos -->
    <div class="bg-black/[.25] w-full h-fit rounded px-4 py-3 mt-4 backdrop-blur-md z-10">
        @foreach($organized as $order)
        <section class="mt-6">
            <h2 class="text-2xl font-semibold text-white">{{ $order['name'] }}</h2>

            @foreach($order['families'] as $family)
            <div class="mt-4">
                <h3 class="text-xl font-semibold text-white pl-4">{{ $family['name'] }}</h3>

                <div class="flex flex-wrap gap-4 mt-3">
                    @foreach($family['insects'] as $insect)
                    <x-insect-card
                        :id="$insect['id']"
                        :common_name="$insect['common_name']"
                        :scientific_name="$insect['scientific_name']" />
                    @endforeach
                </div>
            </div>
            @endforeach

        </section>
        @endforeach
    </div>
</div>
@endsection