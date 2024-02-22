@extends('index')

@section('konten')
<main class="max-w-screen-xl md:w-10/12 mx-auto flex-1">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        @for ($i = 0; $i < 8; $i++)
        <div class="p-0 sm:p-1 md:p-2 xl:p-5">
            <a href="/blog/1">
                <article>
                    <img loading="lazy" src="image/header.png" alt="tes">
                    <div class="m-5">
                        <h2 class="font-bold text-2xl text-neutral-800">Content Title</h2>
                        <p class="text-neutral-500 pb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus numquam ab, error accusantium ex repellat...</p>
                        <p class="text-neutral-500 hover:text-neutral-900">Show More</p>
                    </div>
                </article>
            </a>
        </div>
        @endfor
    </div>
</main>
@endsection