@extends('index')

@section('konten')
    <header class="mx-auto w-full md:w-10/12 max-w-screen-xl">
        <img class="" src="{{asset("storage/home/intro.gif")}}" alt="">
    </header>
    <main class="mx-auto max-w-screen-xl w-11/12 md:w-10/12 flex-1">
        
        <x-product :product="$product"/>

        <x-article :article="$article"/>

        {{-- <img class="mt-10" loading="lazy" src="{{asset("storage/home/header.webp")}}" alt=""> --}}
        <div class="mx-auto w-full md:w-10/12 py-10">
            <iframe style="border-radius:12px" height="352" src="https://open.spotify.com/embed/track/6NDNtmBCVHJ5aR9QSArL8R?utm_source=generator" width="100%" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
        <div class="mx-auto w-full md:w-8/12 lg:w-6/12 py-10">
            <iframe loading="lazy" class="w-full aspect-video" src="https://www.youtube.com/embed/b2RDyjXtZ98?si=gtUzgCqv69waPEo7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </main>
@endsection
