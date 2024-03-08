<div class="flex w-full">

    @php $i=0; @endphp 
    @foreach ($detail as $data)
    @if ($data->id_content == $content->id)
    @php $i++ @endphp
    @switch($data->type)
        @case("image")
        <label for="choose-file-{{$data->id}}" class="flex-1 flex justify-center items-center relative hover:cursor-pointer p-3 mx-1 border-2 border-neutral-400 border-dashed rounded-md aspect-square">
            <div id="img-preview-{{$data->id}}" class="inline-flex max-h-full">   

                @if(empty($data->description))
                    <div class="flex flex-col items-center">
                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span></p>
                        <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF</p>
                    </div>
                @else
                <img src="/image/article/{{$id}}/{{$data->description}}" class="object-contain" loading="lazy">
                @endif
                <input name="image[{{$data->id}}]" type="file" id="choose-file-{{$data->id}}" accept="image/png, image/jpeg, image/webp" onchange="getImgData('choose-file-{{$data->id}}', 'img-preview-{{$data->id}}')" value="null" hidden>
                <button onclick="modalvalue('detail', '{{$data->id}}')" class="absolute right-1 top-1 rounded-full p-2 hover:bg-gray-100 active:bg-gray-200" type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal">
                    <svg class="w-6 h-6 text-gray-600 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="-12 5 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" class="rotate-45"/>
                    </svg>
                </button>
            </div>

        </label>
            @break
        @case("text")
            <div class="flex-1 relative mx-1">
                <textarea class="w-full" name="text[{{$data->id}}]" placeholder="Article Text" rows="4">{{$data->description}}</textarea>
                <button onclick="modalvalue('detail', '{{$data->id}}')" class="absolute right-1 top-1 rounded-full p-2 hover:bg-gray-100 active:bg-gray-200" type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal">
                    <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="-12 5 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" class="rotate-45"/>
                    </svg>
                </button>
            </div>
            @break
        @default

    @endswitch
    @endif
    @endforeach
    @if ($i < 5)

    <div id="newContent{{$content->id}}" class="my-auto mx-3">
        <button onclick="newContent('newContent{{$content->id}}', 'selectContent{{$content->id}}')" class="rounded-full p-2 border-2 border-gray-500 hover:bg-gray-100" type="button">
            <svg class="size-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
            </svg>
        </button>
        <button onclick="modalvalue('content', '{{$content->id}}')" data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="rounded-full p-2 border-2 border-gray-500 hover:bg-gray-100" type="button">
            <svg class="size-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M8.6 2.6A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4c0-.5.2-1 .6-1.4ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
            </svg>                
        </button>
    </div>

    <div class="my-auto">
        <div id="selectContent{{$content->id}}" class="hidden grid grid-cols-2 mx-3 gap-1">
            {{-- text --}}
            <button class="rounded-full p-2 border-2 border-gray-500 hover:bg-gray-100" type="submit" name="submit" value="-1,{{$content->id}}">
                <svg class="size-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6.2V5h11v1.2M8 5v14m-3 0h6m2-6.8V11h8v1.2M17 11v8m-1.5 0h3"/>
                </svg>
            </button>
            {{-- cancel --}}
            <button onclick="cancelContent('newContent{{$content->id}}', 'selectContent{{$content->id}}')" class="rounded-full p-2 border-2 border-gray-500 hover:bg-gray-100" type="button">
                <svg class="size-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="-12 5 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" class="rotate-45"/>
                </svg>
            </button>
            {{-- image --}}
            <button class="rounded-full p-2 border-2 border-gray-500 hover:bg-gray-100" type="submit" name="submit" value="-2,{{$content->id}}">
                <svg class="size-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.3 6m2.3-9h0M4 19h16c.6 0 1-.4 1-1V6c0-.6-.4-1-1-1H4a1 1 0 0 0-1 1v12c0 .6.4 1 1 1Z"/>
                </svg>
            </button>
            {{-- product --}}
            <button class="rounded-full p-2 border-2 border-gray-500 hover:bg-gray-100" type="submit" name="submit" value="-3,{{$content->id}}">
                <svg class="size-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 1 12c0 .5-.5 1-1 1H6a1 1 0 0 1-1-1L6 8h12Z"/>
                </svg>
            </button>
        </div>
    </div>
    @endif
</div>