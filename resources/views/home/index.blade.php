@extends('index')

@section('konten')
    <header class="mx-auto w-full md:w-10/12 max-w-screen-xl">
        <img class="" src="{{asset("storage/home/intro.gif")}}" alt="">
    </header>
    <main class="mx-auto max-w-screen-xl md:w-10/12 flex-1">
        
        <x-product :product="$product"/>

        <x-article :article="$article"/>

        <img loading="lazy" src="{{asset("storage/home/header.webp")}}" alt="">
        <div class="mx-auto w-full md:w-8/12 lg:w-5/12 py-10">
            <iframe loading="lazy" class="w-full aspect-video" src="https://www.youtube.com/embed/b2RDyjXtZ98?si=gtUzgCqv69waPEo7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </main>
@endsection
