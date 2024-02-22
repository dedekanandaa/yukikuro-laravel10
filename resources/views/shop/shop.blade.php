@extends('index')
@section('konten')
    <main class="mx-auto max-w-screen-xl md:w-10/12 md:pt-10 flex-1">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4">
            @for ($i = 0; $i < 13; $i++)
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
    </main>
@endsection
