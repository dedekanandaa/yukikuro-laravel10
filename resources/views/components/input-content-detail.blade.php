<div class="grid {{'grid-cols-'.$content->many_cols}} gap-3 items-center">

    @foreach ($detail as $data)
    @if ($data->id_content == $content->id)
    @switch($content->type)
        @case("image")

        <label for="choose-file-{{$data->id}}" class="hover:cursor-pointer">
            <div id="img-preview-{{$data->id}}" class="border-2 border-neutral-400 border-dashed rounded-md aspect-square p-3 place-content-center place-items-center grid">   
                <div class="contents">

                @if(empty($data->description))
                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span></p>
                <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF</p>
                
                @else
                <img src="/image/article/{{$id}}/{{$data->description}}">
                
                @endif
                </div>
            </div>
            <input name="image[{{$data->id}}]" type="file" id="choose-file-{{$data->id}}" accept="image/png, image/jpeg, image/webp" onchange="getImgData('choose-file-{{$data->id}}', 'img-preview-{{$data->id}}')" value="null" hidden>
        </label>

            @break
        @case("text")
            <textarea name="text[{{$data->id}}]" placeholder="Article Text" rows="4">{{$data->description}}</textarea>
            @break
        @default

    @endswitch
    @endif
    @endforeach

</div>