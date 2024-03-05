<div class="grid {{"lg:grid-cols-".$item->many_cols}} items-center">

    @foreach ($detail as $data)
    @if ($data->id_content == $item->id)
    @switch($item->type)
        @case("image")
            
            <div>
                @empty(!$data->description)
                <img src="/image/article/{{ $item->id_article.'/'.$data->description }}">
                @endempty
            </div>
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
