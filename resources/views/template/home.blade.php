@extends('index')

@section('konten')
    <header class="mx-auto w-full md:w-10/12 max-w-screen-xl">
        <img class="" src="image/intro.gif" alt="">
    </header>
    <main class="mx-auto max-w-screen-xl md:w-10/12 flex-1">
        
        <div class="grid grid-cols-2 md:grid-cols-4">
            @for ($i = 0; $i < 8; $i++)

            <div class="m-0 md:m-1 lg:m-6">
                <a href="/shop/1">
                    <span class="absolute bg-neutral-400 text-neutral-100 text-sm font-thin mt-3 ml-3 px-2.5 py-1 rounded">Sold out</span>
                    <img src="image/BLACK FRONT.png" alt="article 1">
                    <div class="text-center">
                        <p class="text-sm font-semibold">Article 1</p>
                        <p class="text-sm font-normal text-neutral-500 pb-5">Rp. 100.000</p>
                    </div>
                </a>
            </div>

            @endfor
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            @for ($i = 0; $i < 6; $i++)
            <div class="p-0 sm:p-1 md:p-2 xl:p-5">
                <a href="/blog/1">
                    <article>
                        <img loading="lazy" src="image/header.png" alt="tes">
                        <div class="m-5">
                            <h2 class="font-bold text-2xl text-neutral-800">Content Title</h2>
                            <p class="text-neutral-500 pb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus numquam ab, error accusantium ex repellat...</p>
                            <a href="#" class="text-neutral-500 hover:text-neutral-900">Show More</a>
                        </div>
                    </article>
                </a>
            </div>
            @endfor   
        </div>

        <img loading="lazy" src="image/header.png" alt="">
        <div class="mx-auto w-full md:w-8/12 lg:w-5/12 py-10">
            {{-- <iframe loading="lazy" class="w-full aspect-video" src="https://www.youtube.com/embed/b2RDyjXtZ98?si=gtUzgCqv69waPEo7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}
        </div>
    </main>
@endsection
