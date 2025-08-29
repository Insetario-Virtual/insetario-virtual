@extends('layouts.admin-layout')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Culturas</h2>
    <a href="{{ route('admin.cultures.create') }}"
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Adicionar Cultura</a>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded-lg shadow">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 text-left">Nome</th>
                <th class="py-2 px-4 text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cultures as $culture)
            <tr class="border-b">
                <td class="py-2 px-4">{{ $culture->name }}</td>
                <td class="py-2 px-4 text-center space-x-2">
                    <a href="{{ route('admin.cultures.edit', $culture->id) }}"
                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>
                    <form action="{{ route('admin.cultures.destroy', $culture->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                                onclick="return confirm('Deseja realmente excluir?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection