<a href="{{ route('insects.show', ['id' => $id]) }}" 
   class="block rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
    <div class="h-40 bg-gray-100 overflow-hidden">
        <img src="{{ $image }}" alt="Imagem de {{ $name }}" class="w-full h-full object-cover">
    </div>
    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-800">{{ $name }}</h3>
        <p class="text-sm text-gray-600 italic">{{ $scientificName }}</p>
    </div>
</a>