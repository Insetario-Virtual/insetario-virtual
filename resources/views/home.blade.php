@extends('layouts.app')

@section('content')
<div class="pb-4 w-full h-fit px-10 max-sm:px-4 bg-fixed bg-no-repeat bg-cover bg-center">

    <h1 class="pt-20 text-3xl font-bold text-white mb-6 md:text-4xl">Informações do Projeto</h1>

    <div class="w-full h-fit rounded py-3 z-10">

        @foreach ($siteContent as $content)
        <section class="mb-2">
            <h2 class="mt-2 text-xl font-semibold text-white md:text-2xl">{{ $content->title }}</h2>

            <p class="w-full text-justify text-white pl-0 pt-3 pb-4 text-base md:pl-12 md:text-lg">
                {{ $content->description }}
            </p>
        </section>
        @endforeach

        <section class="mt-8">
            <h2 class="mt-3 text-xl font-semibold text-white md:text-2xl">Equipe:</h2>
            <div class="w-full h-fit flex justify-center gap-4 flex-wrap mt-3">
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