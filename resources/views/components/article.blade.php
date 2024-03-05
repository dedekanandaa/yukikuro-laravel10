<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
    @isset($article)
    @foreach ($article as $item)
    <div class="p-0 sm:p-1 md:p-2 xl:p-5 bg-white">
        <a href="/blog/{{$item->title}}">
            <article class="space-y-5">
                <img loading="lazy" class="w-full aspect-[3/2] object-cover" src="/image/article/{{$item->id ."/". $item->thumbnail}}">
                <div>
                    <h2 class="font-bold text-2xl text-neutral-800">{{$item->title}}</h2>
                    <p class="text-neutral-500 line-clamp-2">{{$item->description}}</p>
                    <p class="text-neutral-500 hover:text-neutral-900 text-xs text-end">Show More</p>
                </div>
            </article>
        </a>
    </div>
    @endforeach
    @endisset
</div>