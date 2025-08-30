@extends('layouts.admin-layout')

@section('title', 'Insectary')

@section('content')
<div class="p-1">

    <!-- Header with "Add Insect" button -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[#22371c]">Insetário</h2>

        <div class="flex space-x-2">
            <a href="{{ route('admin.dashboard') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Voltar</a>

            <a href="{{ route('admin.insectary.create') }}" class="bg-[#445a1b] hover:bg-[#22371c] text-white px-4 py-2 rounded">
                Adicionar novo inseto
            </a>
        </div>
    </div>

    @foreach($orders as $order)
    <section class="mb-8">
        <h3 class="text-2xl font-semibold text-[#22371c] mb-4">{{ $order->name }}</h3>

        @foreach($order->families as $family)
        <div class="mb-6">
            <h4 class="text-xl font-semibold text-[#445a1b] mb-2">{{ $family->name }}</h4>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border rounded-md">
                    <thead>
                        <tr class="bg-[#22371c] text-white text-left">
                            <th class="px-4 py-2">Nomes Comuns</th>
                            <th class="px-4 py-2">Nome Científico</th>
                            <th class="px-4 py-2">Predador</th>
                            <th class="px-4 py-2">Importância</th>
                            <th class="px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($family->insects as $insect)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $insect->commonNames->pluck('name')->implode(', ') }}</td>
                            <td class="px-4 py-2 italic">{{ $insect->scientific_name }}</td>
                            <td class="px-4 py-2">{{ $insect->predator ? 'Sim' : 'Não' }}</td>
                            <td class="px-4 py-2">{{ $insect->importance }}</td>
                            <td class="px-4 py-2 space-x-2 flex">
                                <a href="{{ route('admin.insectary.edit', $insect->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Edit</a>
                                <form action="{{ route('admin.insectary.destroy', $insect->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if($family->insects->isEmpty())
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center text-gray-500">Nenhum Inseto Encontrado</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </section>
    @endforeach

</div>
@endsection