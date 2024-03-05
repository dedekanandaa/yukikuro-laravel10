<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4">
    @isset ($product)
    @foreach ($product as $item)
        
        <div class="m-0 md:m-1 lg:m-6">
            <a href="/shop/{{$item->name}}">
                @if ($item->total == 0)
                <span class="absolute bg-neutral-800/70 text-neutral-100 text-sm font-thin mt-3 ml-3 px-2.5 py-1 rounded">Sold out</span>
                @endif
                <figure class="aspect-square place-content-center grid">
                    <img class="w-full" src="/image/product/{{$item->id.'/'.$item->thumbnail}}" alt="">
                </figure>
                <div class="text-center">
                    <p class="text-sm font-semibold">{{$item->name}}</p>
                    <p class="text-sm font-normal text-neutral-500 pb-5">{{ 'Rp. '.number_format($item->price, 0, ',', '.') }}</p>
                </div>
            </a>
        </div>
        
    @endforeach
    @endisset
</div>