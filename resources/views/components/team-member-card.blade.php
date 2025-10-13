<div class="flex gap-0.5 items-center w-full pl-3 pr-2 py-2 max-lg:h-22 md:w-5/12 rounded-l-full md:rounded-lg shadow-md mb-4 bg-white/65">
    <img src="{{ asset("/storage/teamImages/" . $member->image_path)  }}" alt="{{ $member->name }}" class="h-16 w-16 md:h-20 md:w-20 rounded-full object-cover" />
    <div class="py-2 flex-grow flex flex-col justify-center items-center text-center text-lg sm:text-xl">
        <h3>{{ $member->name }}</h3>
        <p class="text-gray-600">{{ $member->role }}</p>
    </div>
</div>