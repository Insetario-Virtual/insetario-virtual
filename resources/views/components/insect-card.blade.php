@props(['id', 'common_name', 'scientific_name', 'image_path' => null])

<a href="{{ route('insetario.show', ['id' => $id]) }}" 
   class="block rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
    <div class="h-40 bg-gray-100 overflow-hidden">
        <img src="{{ $image_path }}" alt="Imagem de {{ $common_name }}" class="w-full h-full object-cover">
    </div>
    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-800">{{ $common_name }}</h3>
        <p class="text-sm text-gray-600 italic">{{ $scientific_name }}</p>
    </div>
</a>