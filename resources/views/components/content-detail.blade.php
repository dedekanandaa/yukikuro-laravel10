<div class="grid grid-cols-{{$item->many_cols}}">

    @foreach ($detail as $data)
    @if ($data->id_content == $item->id)
    @switch($item->type)
        @case("image")
            <img src="/image/article/{{ $item->id_article.'/'.$data->description }}" alt="">
            
            @break
        @case("text")
            <p class="p-5">{{ $data->description }}</p>
            @break
        @default
            {{-- belum dikoding --}}
    @endswitch
    @endif
    @endforeach
</div>
