@extends('layouts.app')

@vite(['resources/js/modal.js'])

@section('content')
@php
// Funções de formatação
function formatCommonName($name, $index) {
if (!$name) return '';
return $index === 0 ? ucfirst($name) : strtolower($name);
}

function formatScientificName($name) {
if (!$name) return '';

$nonItalic = ['sp', 'spp', 'cf', 'aff', 'var', 'subsp', 'f', 'nom\. nov'];

$words = preg_split('/\s+/', $name);

$formatted = [];

foreach ($words as $word) {
$cleanWord = rtrim($word, '.');

if (in_array(strtolower($cleanWord), $nonItalic)) {
$formatted[] = $word;
} else {
$formatted[] = "<em>{$word}</em>";
}
}

return implode(' ', $formatted);
}

function formatTextWithItalic($text) {
if (!$text) return '';
$italicWords = ['Polistes', 'Polybia', 'Pepsis', 'Spodoptera frugiperda', 'Lethocerus', 'Citrus', 'Dalechampia', 'Brunfelsia'];
foreach ($italicWords as $word) {
$text = preg_replace("/\b($word)\b/i", '<em>$1</em>', $text);
}
return $text;
}
@endphp


<div class="pb-4 w-full h-fit px-10 max-sm:px-4 text-white">

    {{-- MODAL DE IMAGENS --}}
    <div id="imageModal"
        class="hidden fixed inset-0 bg-black bg-opacity-80 backdrop-blur-sm flex justify-center items-center z-50 p-9">
        <button id="prevImage" class="absolute left-4 text-white text-2xl">❮❮</button>
        <img id="modalImage" src="" alt="Imagem ampliada"
            class="max-w-full max-h-full object-contain rounded-lg" />
        <button id="nextImage" class="absolute right-4 text-white text-2xl">❯❯</button>
    </div>

    {{-- Cabeçalho --}}
    <div class="pt-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-white max-lg:text-xl">Detalhes sobre o inseto</h1>
        <a href="{{ route('insetario.index') }}">
            <button class="p-2 bg-white/90 hover:bg-white/80 text-lg transition-all ease-in-out duration-200 max-md:text-base text-black font-semibold rounded">
                Voltar
            </button>
        </a>
    </div>

    {{-- Conteúdo principal --}}
    <div class="flex flex-col gap-3 bg-black/[.30] w-full h-fit rounded px-3 sm:px-5 py-3 mt-4 backdrop-blur-md z-10 text-white text-lg sm:text-xl">

        {{-- Botão fixo para voltar --}}
        <a href="{{ route('insetario.index') }}"
            class="fixed top-4 right-4 z-50">
            <button class="px-3 py-1 rounded-lg text-white bg-[#445a1b] hover:opacity-90">
                ❮❮
            </button>
        </a>

        {{-- Nome Científico --}}
        <p>
            <span class="font-semibold text-lg sm:text-xl">Nomes Científico: </span>
            <span>
                {!!formatScientificName($insect->scientific_name)!!}
            </span>
        </p>

        {{-- Nomes Comuns --}}
        <p>
            <span class="font-semibold text-lg sm:text-xl">Nomes Comuns: </span>
            <span>
                @foreach ($insect->commonNames as $index => $name)
                {{ formatCommonName($name->name, $index) }}
                @if (!$loop->last), @endif
                @endforeach
            </span>
        </p>

        {{-- Culturas --}}
        @if (count($insect->cultures))
        <section>
            <span class="font-semibold text-base sm:text-xl">Culturas que Ataca:</span>
            <ul class="mt-2 space-y-1 ml-10">
                @foreach ($insect->cultures as $culture)
                <li class="text-base sm:text-lg list-disc">
                    {{ formatCommonName($culture->name, 0) }}
                </li>
                @endforeach
            </ul>
        </section>
        @endif

        {{-- Imagens --}}
        @if (!empty($insect->images))

        <section class="w-full">
            <h2 class="text-lg sm:text-xl font-bold">Imagens do Inseto:</h2>
            <div class="p-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach ($insect->images as $index => $image)
                <div class="col-span-1">
                    <img src="{{ "/storage/" . $image->image_path }}" alt="Imagem do inseto"

                    class="w-full h-auto rounded shadow-lg cursor-pointer insect-image"
                    data-index="{{ $index }}" />
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- Tabela Ordem/Família --}}
        <section class="w-full my-6">
            <table class="m-auto w-full max-w-2xl text-left rounded-lg overflow-hidden shadow-lg">
                <thead class="bg-[#22371c] text-white">
                    <tr>
                        <th class="p-3 text-center">Ordem</th>
                        <th class="p-3 text-center">Família</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="text-center bg-[#445a1b]/70">
                        <td class="p-3 font-bold">{{ $insect->order->name }}</td>
                        <td class="p-3 font-bold">{{ $insect->family->name }}</td>
                    </tr>
                </tbody>
            </table>
        </section>

        {{-- Importância --}}
        @if (!empty($insect->importance))
        <section class="flex flex-col gap-1">
            <h3 class="font-semibold text-xl">Importância:</h3>
            <p class="pl-4 text-base sm:text-lg">
                {!! formatTextWithItalic($insect->importance) !!}
            </p>
        </section>
        @endif

        {{-- Morfologia --}}
        @if (!empty($insect->morphology))
        <section class="flex flex-col gap-1">
            <h3 class="font-semibold">Morfologia:</h3>
            <p class="pl-4 text-base sm:text-lg">
                {!! formatTextWithItalic($insect->morphology) !!}
            </p>
        </section>
        @endif

    </div>
</div>
@endsection