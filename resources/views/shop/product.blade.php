@extends('index')

@push('splide')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
@endPush

@section('konten')
    <main class="grid grid-cols-1 md:grid-cols-2 mx-auto max-w-screen-xl h-full w-10/12 md:my-12 flex-1">
        <section class="p-0 md:mr-12 select-none">

            <div class="swiper product-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide opacity-100" onmousemove="zoom(event)" style="background-image: url('{{asset("storage/product/{$product->value('id')}/{$product->value('thumbnail')}")}}')">
                        <img class="hover:opacity-0 bg-white" src="{{asset("storage/product/{$product->value('id')}/{$product->value('thumbnail')}")}}" >
                    </div>
                    @foreach ($image as $item)
                    <div class="swiper-slide opacity-100" onmousemove="zoom(event)" style="background-image: url('{{asset("/storage/product/{$item->id_product}/{$item->image}")}}')">
                        <img class="hover:opacity-0 bg-white" src="{{asset("/storage/product/{$item->id_product}/{$item->image}")}}" >
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next" style="color: black;"></div>
                <div class="swiper-button-prev" style="color: black;"></div>
            </div>
            
            <div class="swiper thumbnail-slider mt-3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide opacity-50">
                        <img class="hover:opacity-50" src="{{asset("storage/product/{$product->value('id')}/{$product->value('thumbnail')}")}}" >
                    </div>
                    @foreach ($image as $item)
                    <div class="swiper-slide opacity-50">
                        <img class="hover:opacity-50" src="{{asset("/storage/product/{$item->id_product}/{$item->image}")}}" >
                    </div>
                    @endforeach
                </div>
            </div>

        </section>

        <div class=" m-0 p-4 border-transparent md:border-neutral-300 border-l-2 md:pl-12">
            <h1 class="text-4xl font-bold mb-4">{{ $product[0]->name }}</h1>
            <p class="text-3xl mb-4">{{ 'Rp. '.number_format($product[0]->price, 0, ',', '.') }}</p>
            <div class="text-neutral-500 text-sm mb-4">
                <p class="mb-2">Details : </p>
                <p class="font-thin">{{ $product[0]->description}}</p>
            </div>
            
            @empty (!$stock->value('size'))
            <div class="mb-4">
                <p>Size :</p>
                <ul class="flex gap-2">
                    @foreach ($stock as $item)

                    <x-product-size :qty="$item->qty">
                        {{$item->size}}
                    </x-product-size>
                        
                    @endforeach
                </ul>
            </div>
                
            @endempty
            
            <div class="flex gap-3">
                <div class="relative flex items-center gap-2">
                    <button type="button" id="decrement-button" data-input-counter-decrement="counter-input" class="bg-white hover:bg-gray-200 inline-flex items-center border border-gray-500 justify-center p-3 active:bg-gray-300">
                        <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                        </svg>
                    </button>
                    <input type="text" id="counter-input" data-input-counter data-input-counter-min="1" data-input-counter-max="5" class="flex-shrink-0 text-gray-900 dark:text-white border bg-transparent text-sm font-normal focus:border-black focus:outline-none focus:ring-0 max-w-[2.5rem] text-center" placeholder="" value="1" required />
                    <button type="button" id="increment-button" data-input-counter-increment="counter-input" class="bg-white hover:bg-gray-200 inline-flex items-center border border-gray-500 justify-center p-3 active:bg-gray-300">
                        <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                        </svg>
                    </button>
                </div>
                <button type="submit" class="grow text-white bg-neutral-700 hover:bg-neutral-600 active:bg-neutral-700">
                    Add to Cart
                </button>
            </div>
        </div>
    </main>

    <style>
    .thumbnail-slider .swiper-slide-thumb-active {
      opacity: 1;
    }
    </style>
    <script>
        function zoom(e){
            var zoomer = e.currentTarget;
            e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
            e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
            x = offsetX/zoomer.offsetWidth * 100
            y = offsetY/zoomer.offsetHeight * 100
            zoomer.style.backgroundPosition = x + '% ' + y + '%';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var thumbnail = new Swiper(".thumbnail-slider", {
            spaceBetween: 10,
            freeMode: true,
            watchSlidesProgress: true,
            slidesPerView: 3,
            breakpoints: {
                768 : {
                    slidesPerView: 4,
                },
            }
        });
        var product = new Swiper(".product-slider", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: thumbnail,
            },
        });
    </script>
@endsection
