@extends('index')

@section('konten')

<main class="max-w-screen-xl md:w-9/12 mx-auto flex-1">
    <h1 class="text-2xl font-bold p-5">{{ $article[0]->title }}</h1>
    <img class="mx-auto min-w-full" src="/image/article/{{$article[0]->id . '/' . $article[0]->thumbnail}}" alt="header.img">
    <p class="p-5">{{$article[0]->description}}</p>
    
    @foreach ($content as $item)
    
    <x-content-detail :item="$item" :detail="$detail"></x-content-detail>

    @endforeach
    
</main>

@endsection
