<div onclick="window.location='{{ route('insects.show', ['id' => $id]) }}'"
    class="bg-white shadow-md rounded-lg p-2 sm:p-4 ml-4 max-w-full h-28 sm:w-60 sm:h-80 flex sm:flex-col hover:bg-white/90 cursor-pointer">

    <img src="{{ asset($imagePath) }}" alt="Imagem do inseto"
        class="max-sm:max-w-36 h-full sm:h-44 object-cover rounded-md" />

    <div class="w-full flex-grow flex flex-col justify-center items-center text-wrap text-center">
        <h3 class="mt-2 text-lg font-bold text-black/90">
            {{ $formattedCommonName() }}
        </h3>
        <p class="text-gray-500 italic">{!! $formattedScientificName() !!}</p>
    </div>
</div>