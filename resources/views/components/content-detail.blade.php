<div class="flex flex-col md:flex-row gap-2">
    @foreach ($detail as $data)
    @if ($data->id_content == $item->id)
    @switch($data->type)
        @case("image")
                @empty(!$data->description)
                    @php(list($width, $height) = getImageSize(storage_path("app/public/article/{$item->id_article}/{$data->description}")))
                    <div class="asdf" style="--ratio : {{$width.'/'.$height}};">
                        <img src="{{asset("storage/article/{$item->id_article}/{$data->description}")}}" class="w-full" loading="lazy">
                    </div>
                @endempty
            @break

        @case("text")

            <p class="text-justify">{{ $data->description }}</p>
            @break

        @default
            {{-- belum dikoding --}}

    @endswitch
    @endif
    @endforeach

</div>