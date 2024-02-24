@extends('index')

@section('konten')
<main class="max-w-screen-xl md:w-10/12 mx-auto flex-1">
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
</main>
@endsection