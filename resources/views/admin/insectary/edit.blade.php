@extends('layouts.admin-layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold mb-4">Editar Inseto</h1>
        <a href="{{ route('admin.insectary.index') }}"
            class="px-4 py-2 rounded-xl text-white bg-[#445a1b] hover:opacity-90">
            Voltar
        </a>
    </div>
    <form action="{{ route('admin.insects.update', $insect->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Scientific Name -->
        <div class="mb-4">
            <label for="scientific_name" class="block font-medium">Nome Científico:</label>
            <input type="text" name="scientific_name" id="scientific_name"
                value="{{ old('scientific_name', $insect->scientific_name) }}"
                class="w-full border rounded px-3 py-2">
            @error('scientific_name') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Order -->
        <div class="mb-4">
            <label for="order_id" class="block font-medium">Ordem:</label>
            <select name="order_id" id="order_id" class="w-full border rounded px-3 py-2">
                @foreach($orders as $order)
                <option value="{{ $order->id }}"
                    {{ old('order_id', $insect->order_id) == $order->id ? 'selected' : '' }}>
                    {{ $order->name }}
                </option>
                @endforeach
            </select>
            @error('order_id') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Family -->
        <div class="mb-4">
            <label for="family_id" class="block font-medium">Família:</label>
            <select name="family_id" id="family_id" class="w-full border rounded px-3 py-2">
                @foreach($families as $family)
                <option value="{{ $family->id }}"
                    {{ old('family_id', $insect->family_id) == $family->id ? 'selected' : '' }}>
                    {{ $family->name }}
                </option>
                @endforeach
            </select>
            @error('family_id') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Predator -->
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="predator" value="1"
                    {{ old('predator', $insect->predator) ? 'checked' : '' }}>
                <span class="ml-2">Predador</span>
            </label>
        </div>

        <!-- Importance -->
        <div class="mb-4">
            <label for="importance" class="block font-medium">Importância:</label>
            <textarea name="importance" id="importance" class="w-full border rounded px-3 py-2">{{ old('importance', $insect->importance) }}</textarea>
        </div>

        <!-- Morphology -->
        <div class="mb-4">
            <label for="morphology" class="block font-medium">Morfologia:</label>
            <textarea name="morphology" id="morphology" class="w-full border rounded px-3 py-2">{{ old('morphology', $insect->morphology) }}</textarea>
        </div>

        <!-- Common Names -->
        <div class="mb-4">
            <label class="block font-medium">Nome Comum:</label>
            <div id="common-names-container">
                @php
                $commonNames = old('common_names', $insect->commonNames->pluck('name')->toArray());
                @endphp
                @foreach($commonNames as $name)
                <input type="text" name="common_names[]" value="{{ $name }}"
                    class="w-full border rounded px-3 py-2 mb-2">
                @endforeach
            </div>
            <button type="button" onclick="addInput('common-names-container','common_names[]')"
                class="bg-blue-600 text-white px-3 py-1 rounded">+ Adicionar Novo Nome Comum</button>
        </div>

        <!-- Cultures -->
        <div class="mb-4">
            <label for="cultures" class="block font-medium">Culturas:</label>
            <select name="cultures[]" id="cultures" multiple class="w-full border rounded px-3 py-2">
                @foreach($cultures as $culture)
                <option value="{{ $culture->id }}"
                    {{ in_array($culture->id, old('cultures', $insect->cultures->pluck('id')->toArray())) ? 'selected' : '' }}>
                    {{ $culture->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Images -->
        <div class="mb-4">
            <label class="block font-medium">Imagens:</label>
            <div class="mb-2">
                @foreach($insect->images as $img)
                <img src="{{ asset('storage/'.$img->path) }}" alt="Insect image" class="w-24 h-24 object-cover inline-block mr-2">
                @endforeach
            </div>
            <div id="images-container">
                <input type="file" name="images[]" class="w-full border rounded px-3 py-2 mb-2">
            </div>
            <button type="button" onclick="addInput('images-container','images[]','file')"
                class="bg-blue-600 text-white px-3 py-1 rounded">+ Adicionar Nova Imagem</button>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Editar Inseto</button>
    </form>
</div>
@endsection