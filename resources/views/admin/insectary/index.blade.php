@extends('admin.admin-layout')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Insetos</h2>
    <a href="{{ route('admin.insectary.create') }}"
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Adicionar Inseto</a>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded-lg shadow">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 text-left">Nome Científico</th>
                <th class="py-2 px-4 text-left">Ordem</th>
                <th class="py-2 px-4 text-left">Família</th>
                <th class="py-2 px-4 text-center">Predador</th>
                <th class="py-2 px-4 text-left">Importância</th>
                <th class="py-2 px-4 text-left">Morfologia</th>
                <th class="py-2 px-4 text-left">Nomes Comuns</th>
                <th class="py-2 px-4 text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($insects as $insect)
            <tr class="border-b">
                <td class="py-2 px-4">{{ $insect->scientific_name }}</td>
                <td class="py-2 px-4">{{ $insect->order->name ?? 'N/A' }}</td>
                <td class="py-2 px-4">{{ $insect->family->name ?? 'N/A' }}</td>
                <td class="py-2 px-4 text-center">{{ $insect->predator ? 'Sim' : 'Não' }}</td>
                <td class="py-2 px-4">{{ $insect->importance }}</td>
                <td class="py-2 px-4">{{ $insect->morphology }}</td>
                <td class="py-2 px-4">
                    {{ $insect->commonNames->pluck('name')->implode(', ') }}
                </td>
                <td class="py-2 px-4 text-center space-x-2">
                    <a href="{{ route('admin.insectary.edit', $insect->id) }}"
                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>
                    <form action="{{ route('admin.insectary.destroy', $insect->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                                onclick="return confirm('Deseja realmente excluir este inseto?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection