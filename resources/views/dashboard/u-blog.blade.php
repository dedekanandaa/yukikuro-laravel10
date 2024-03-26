@extends('dashboard.index')

@section('content')
    
<form action="/dashboard/blog/edit" method="POST" enctype="multipart/form-data" class="space-y-4" id="u-blog-form">
    <div class="grid">
        @csrf
        <input type="hidden" name="id" value="{{$article->id}}">
        
        <label class="font-semibold">Blog Title</label>
        <input name="title" type="text" placeholder="Type Title Here" class="font-semibold" value="{{$article->title}}" required>
    </div>
    <label for="choose-file" class="grid gap-3 hover:cursor-pointer">
        <p>Blog Thumbnail</p>
        <div id="img-preview" class="table border-2 border-neutral-400 border-dashed rounded-md p-3">
            <div class="contents">
                <img src="{{asset("storage/article/{$article->id}/{$article->thumbnail}")}}" class="w-full">
            </div>
        </div>
        <input name="thumbnail" type="file" id="choose-file" accept="image/png, image/jpeg, image/webp" onchange="getImgData('choose-file', 'img-preview')" hidden>
    </label>
    <div class="grid">
        <label for="price">Description</label>
        <textarea name="description" placeholder="Description" rows="4" required>{{$article->description}}</textarea>
    </div>

    @foreach ($content as $item)
    <x-input-content-detail :content="$item" :detail="$detail" :id="$article->id"></x-input-content-detail>
    @endforeach

    <div class="flex place-content-center">
        <label for="visibility" class="absolute left-72 inline-flex items-center cursor-pointer">
            <input id="visibility" name="visibility" type="checkbox" class="sr-only peer" @if ($article->visibility) checked @endif>
            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Show Article to Blog</span>
        </label>

        <div id="newContent">
            <button class="rounded-full p-2 border-2 border-gray-500 text-white hover:bg-gray-100" type="submit" name="submit" value="0">
                <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 4.7 4.5 9.3-9"/>
                </svg>
            </button>
            <button onclick="newContent('newContent', 'contentSelect')" class="rounded-full p-2 border-2 border-gray-500 text-white hover:bg-gray-100" type="button">
                <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                  </svg>
            </button>
            <button onclick="modalvalue('blog', '{{$article->id}}')" data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="rounded-full p-2 border-2 border-gray-500 text-white hover:bg-gray-100" type="button">
                <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8.6 2.6A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4c0-.5.2-1 .6-1.4ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                  </svg>                
            </button>
        </div>

        <div class="gap-1 flex hidden" id="contentSelect">
            <button class="hover:bg-gray-100 focus:outline-none border-2 border-gray-500 active:bg-gray-200 font-medium text-sm px-5 py-2.5 text-center flex gap-2" type="submit" name="submit" value="1">
                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6.2V5h11v1.2M8 5v14m-3 0h6m2-6.8V11h8v1.2M17 11v8m-1.5 0h3"/>
                </svg>
                Text
            </button>
            <button class="hover:bg-gray-100 focus:outline-none border-2 border-gray-500 active:bg-gray-200 font-medium text-sm px-5 py-2.5 text-center flex gap-2" type="submit" name="submit" value="2">
                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.3 6m2.3-9h0M4 19h16c.6 0 1-.4 1-1V6c0-.6-.4-1-1-1H4a1 1 0 0 0-1 1v12c0 .6.4 1 1 1Z"/>
                </svg>
                Image
            </button>
            <button class="hover:bg-gray-100 focus:outline-none border-2 border-gray-500 active:bg-gray-200 font-medium text-sm px-5 py-2.5 text-center flex gap-2" type="submit" name="submit" value="3">
                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 1 12c0 .5-.5 1-1 1H6a1 1 0 0 1-1-1L6 8h12Z"/>
                </svg>
                Product
            </button>
            
            <div class="relative flex items-center gap-2">
                <button type="button" id="decrement-button" data-input-counter-decrement="counter-input" class="bg-white hover:bg-gray-200 inline-flex items-center justify-center p-4 active:bg-gray-300">
                    <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                    </svg>
                </button>
                <input type="text" id="counter-input"  name="many_cols" data-input-counter data-input-counter-min="1" data-input-counter-max="5" class="flex-shrink-0 text-gray-900 dark:text-white border bg-transparent text-sm font-normal focus:border-black focus:outline-none focus:ring-0 max-w-[2.5rem] text-center" value="1" required/>
                <button type="button" id="increment-button" data-input-counter-increment="counter-input" class="bg-white hover:bg-gray-200 inline-flex items-center justify-center p-4 active:bg-gray-300">
                    <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                </button>
            </div>

            <button onclick="cancelContent('newContent', 'contentSelect')" class="rounded-full p-2 border-2 border-gray-500 text-white hover:bg-gray-100" type="button">
                <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="-12 5 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" class="rotate-45"/>
                </svg>
            </button>
        </div>
    </div>
</form>

<x-delete-modal id="deletemodal"></x-delete-modal>

<script>
function getImgData(inputId, previewId) {
    const chooseFile = document.getElementById(inputId);
    const imgPreview = document.getElementById(previewId);
    const files = chooseFile.files[0];
    if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
            imgPreview.innerHTML = '<img src="' + this.result + '" class="object-contain"/>';
        });
    }
}

function newContent(newItem, itemList) {
    document.getElementById(newItem).classList.add('hidden')
    document.getElementById(itemList).classList.remove('hidden')
}
function cancelContent(newItem, itemList) {
    document.getElementById(newItem).classList.remove('hidden')
    document.getElementById(itemList).classList.add('hidden')
}
function modalvalue(type,id) {
    document.getElementById("deletebutton").innerHTML = '<a href="/dashboard/' + type +'/delete/'+ id +'" data-modal-hide="delete-modal" type="button" class="w-full text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium text-sm items-center px-5 py-2.5 text-center">Yes</a>'
}
</script>

@endsection