@props(['id', 'common_name', 'scientific_name', 'image_path' => null])

<a href="{{ route('insetario.show', ['id' => $id]) }}"
    class="flex h-32 sm:h-36 rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5 bg-white/95 max-w-3xl mx-auto">
    
    <div class="w-32 h-full bg-gray-100 overflow-hidden flex-shrink-0">
        <img
            src="{{ asset("/" . $image_path) }}"
            alt="{{ $scientific_name }}" 
            class="w-full h-full object-cover">
    </div>
    
    <div class="p-3 sm:p-4 flex flex-col justify-center w-full h-full overflow-hidden">
        
        <h3 class="text-lg font-semibold text-gray-800 capitalize leading-tight truncate">
            {{ $common_name }}
        </h3>
        
        <p class="text-sm text-gray-600 italic leading-tight mt-1 line-clamp-2 overflow-hidden">
            {{ $scientific_name }}
        </p>
    </div>
</a>