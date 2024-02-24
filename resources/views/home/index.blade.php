@extends('index')

@section('konten')
    <header class="mx-auto w-full md:w-10/12 max-w-screen-xl">
        <img class="" src="image/intro.gif" alt="">
    </header>
    <main class="mx-auto max-w-screen-xl md:w-10/12 flex-1">
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4">
            @isset ($product)
            @foreach ($product as $item)
                
                <div class="m-0 md:m-1 lg:m-6">
                    <a href="/shop/{{$item->name}}">
                        <span class="absolute bg-neutral-400 text-neutral-100 text-sm font-thin mt-3 ml-3 px-2.5 py-1 rounded">Sold out</span>
                        <figure class="aspect-square place-content-center grid">
                            <img class="w-full" src="/image/product/{{$item->id.'/'.$item->thumbnail}}" alt="{{$item->name}}.img">
                        </figure>
                        <div class="text-center">
                            <p class="text-sm font-semibold">{{$item->name}}</p>
                            <p class="text-sm font-normal text-neutral-500 pb-5">{{ 'Rp. '.number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                </div>
                
            @endforeach
            @endisset
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            @isset($article)
            @foreach ($article as $item)
                
            <div class="p-0 sm:p-1 md:p-2 xl:p-5">
                <a href="/blog/{{$item->title}}">
                    <article>
                        <img loading="lazy" src="/image/article/{{$item->id ."/". $item->thumbnail}}" alt="tes">
                        <div class="m-5">
                            <h2 class="font-bold text-2xl text-neutral-800">{{$item->title}}</h2>
                            <p class="text-neutral-500 pb-5">{{$item->description}}</p>
                            <p class="text-neutral-500 hover:text-neutral-900 ">Show More</p>
                        </div>
                    </article>
                </a>
            </div>
            @endforeach
            @endisset
        </div>

        <img loading="lazy" src="image/header.png" alt="">
        <div class="mx-auto w-full md:w-8/12 lg:w-5/12 py-10">
            {{-- <iframe loading="lazy" class="w-full aspect-video" src="https://www.youtube.com/embed/b2RDyjXtZ98?si=gtUzgCqv69waPEo7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}
        </div>
    </main>
@endsection
