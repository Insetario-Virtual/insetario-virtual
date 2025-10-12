@extends('layouts.app')

@section('content')
<div class="pb-4 w-full h-fit px-10 max-sm:px-4 bg-fixed bg-no-repeat bg-cover bg-center">

    <h1 class="pt-4 text-2xl font-semibold text-white">Informações do Projeto</h1>

    <div class="w-full h-fit rounded px-4 py-3 mt-4 z-10">

        @foreach ($siteContent as $content)
        <section>
            <h2 class="mt-5 text-xl font-semibold text-white">{{ $content->title }}</h2>
            <p class="w-full text-justify text-white pl-12 pt-3 pb-4 text-lg">
                {{ $content->description }}
            </p>
        </section>
        @endforeach

        <section>
            <h2 class="mt-3 text-xl font-semibold text-white">Equipe:</h2>
            <div class="w-full h-fit flex justify-center gap-2 flex-wrap mt-3">
                @foreach ($members as $member)
                @if ($member->active)
                <x-team-member-card :member="$member" />
                @endif
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection