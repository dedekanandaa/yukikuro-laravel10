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

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
    @isset($article)
    @foreach ($article as $item)
    <div class="p-0 sm:p-1 md:p-2 bg-white">
        <a href="/dashboard/blog/edit/{{$item->id}}">
            <article class="space-y-3">
                <img loading="lazy" class="w-full aspect-[3/2] object-cover" src="{{asset("storage/article/{$item->id}/{$item->thumbnail}")}}">
                <div>
                    <h2 class="font-bold text-lg text-neutral-800">
                        {{$item->title}}
                        @if ($item->visibility)

                        <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            <svg class="size-4 text-green-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4 6-9 6s-9-4.8-9-6c0-1.2 4-6 9-6s9 4.8 9 6Z"/>
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </span>
                        @else

                        <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            <svg class="size-4 text-red-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 14c-.5-.6-.9-1.3-1-2 0-1 4-6 9-6m7.6 3.8A5 5 0 0 1 21 12c0 1-3 6-9 6h-1m-6 1L19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </span>
                        @endif 
                        
                    </h2>
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