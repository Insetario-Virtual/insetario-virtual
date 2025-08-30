@extends('layouts.admin-layout')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Informações do Site</h2>
        <div class="flex space-x-2">
            <a href="{{ route('admin.dashboard') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Voltar</a>

            <a href="{{ route('admin.site-data.create') }}"
                class="bg-[#445a1b] hover:bg-[#2b3910] text-white px-4 py-2 rounded">Adicionar Informações</a>
        </div>
    </div>

    <table class="w-full mt-6 border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">Título</th>
                <th class="border px-4 py-2">Descrição</th>
                <th class="border px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siteContents as $data)
            <tr>
                <td class="border px-4 py-2">{{ $data->title }}</td>
                <td class="border px-4 py-2">{{ $data->description }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('admin.site-data.edit', $data) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                    <form action="{{ route('admin.site-data.destroy', $data) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection