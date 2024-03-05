@extends('dashboard.index')

@section('content')

<div class="flex justify-between items-center">
    <p class="font-bold text-2xl">Blog List
    </p>
    <div>
        <a href="/dashboard/blog/new" class="bg-white p-3 border-2 flex right-12 bottom-7 rounded-md items-center gap-3 ">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-4 w-4 text-gray-200">
            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
            </svg>
            New Blog
        </a>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
    @isset($article)
    @foreach ($article as $item)
    <div class="p-0 sm:p-1 md:p-2 xl:p-5 bg-white">
        <a href="/dashboard/blog/edit/{{$item->id}}">
            <article class="space-y-5">
                <img loading="lazy" class="w-full aspect-[3/2] object-cover" src="/image/article/{{$item->id ."/". $item->thumbnail}}">
                <div>
                    <h2 class="font-bold text-2xl text-neutral-800">{{$item->title}}</h2>
                    <p class="text-neutral-500 line-clamp-2">{{$item->description}}</p>
                    <p class="text-neutral-500 hover:text-neutral-900 text-xs">Show More</p>
                </div>
            </article>
        </a>
    </div>
    @endforeach
    @endisset
</div>

@endsection