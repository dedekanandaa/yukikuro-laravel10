@extends('index')

@section('konten')

<article class="max-w-screen-xl md:w-9/12 mx-auto flex-1 space-y-3">
    <h1 class="text-2xl font-bold">{{ $article->value("title") }}</h1>
    <img class="mx-auto min-w-full" src="{{asset("storage/article/{$article->value("id")}/{$article->value("thumbnail")}")}}" alt="header.img">
    <p class="text-justify">{{$article->value("description")}}</p>
    
    @foreach ($content as $item)
    
    <x-content-detail :item="$item" :detail="$detail"></x-content-detail>

    @endforeach
    
</article>

<style>
    .asdf {
      flex-basis: 0;
      aspect-ratio: var(--ratio);
      flex-grow: calc(var(--ratio));
    }
</style>

@endsection
