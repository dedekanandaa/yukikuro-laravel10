@extends('dashboard.index')

@push('splide')
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@endPush

@section('content')

<form action="/dashboard/product/edit" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-4 mx-auto">
    @csrf
    <input type="hidden" value="{{$product->id}}" name="id">
    <div>
        <label for="choose-file" class="flex-col flex gap-3 hover:cursor-pointer">
            <p class="font-bold">Product Thumbnail</p>
            <div id="img-preview" for="choose-file" class="border-2 border-neutral-400 border-dashed rounded-md size-80 p-3">
                <img src="/image/product/{{$product->id .'/'. $product->thumbnail}}" alt="">
            </div>
            <input name="thumbnail" type="file" id="choose-file" accept="image/png, image/jpeg, image/webp" onchange="getImgData('choose-file', 'img-preview')" hidden>
        </label>

        <section id="thumbnail-carousel" class="splide mt-3 lg:w-80" aria-label="images">
            <div class="splide__track">
                <ul class="splide__list">
                
                @foreach ($image as $data)
                <li class="splide__slide">
                    <div class="max-h-full max-w-full object-cover">
                        <label for="choose-file-{{$data->id}}" class="hover:cursor-pointer h-[154px]">
                            <div id="img-preview-{{$data->id}}" class="border-2 border-neutral-400 border-dashed rounded-md aspect-square p-3 place-content-center place-items-center grid">
                                <div class="contents">
                                @if(empty($data->image))
    
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span></p>
                                    <p class="text-xs text-gray-500">SVG, PNG, JPG or Webp</p>
                                @else
                                
                                    <img src="/image/product/{{$id}}/{{$data->image}}" class="max-w-full max-h-full">
                                @endif
                                </div>
                            </div>
                        <input name="image[{{$data->id}}]" type="file" id="choose-file-{{$data->id}}" accept="image/png, image/jpeg, image/webp" onchange="getImgData('choose-file-{{$data->id}}', 'img-preview-{{$data->id}}')" value="null" hidden>
                        </label>
                    </div>
                </li>
                @endforeach
                
                <li class="splide__slide">
                        <div class="grid w-full h-full place-content-center place-items-center size-6">
                            <button class="rounded-full p-2 border-2 border-gray-500 text-white hover:bg-gray-100" type="button" onclick="getNewContent()">
                                <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                                </svg>
                            </button>
                        </div>
                </li>
                </ul>
            </div>
        </section>

    </div>
    
    <div class="flex-1 grid gap-4 h-min">
        <div class="grid">
            <label for="name">Product Name</label>
            <input name="name" type="text" value="{{$product->name}}" placeholder="Nama Produk">
        </div>
        <div class="grid">
            <label for="price">Price</label>
            <input name="price" type="number" value="{{$product->price}}" placeholder="Harga">
        </div>
        <div class="grid">
            <label for="price">Description</label>
            <textarea name="description" placeholder="Description" rows="4">{{$product->description}}</textarea>
        </div>

        @if(empty($stock[0]->size))
            
        <div class="grid" id="size-form-1">
            <p>Stock</p>
            <input type="hidden" name="id_stock" value="{{$stock[0]->id}}">
            <input type="number" name="qty" value="{{$stock[0]->qty}}" placeholder="Stock">
        </div>
        
        @else
        
        <div class="grid gap-3" id="size-form-2">
            <p>Stock Size</p>
            @foreach ($stock as $key => $item)
            <input type="hidden" name="id_stock_{{$key}}" value="{{$item->id}}">
            <input type="number" name="qty_{{$key}}" value="{{$item->qty}}" placeholder="{{$item->size}}">
            @endforeach
        </div>  

        @endif
        <div class="flex gap-3 items-center"> 
            <input type="checkbox" id="visibility" name="visibility" @if ($product->visibility) checked @endif >
            <label for="visibility">Show Product in Shop</label>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="flex-1 bg-neutral-800 py-2 text-white hover:bg-neutral-900">OK</button>
            <button data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="flex-initial text-white bg-red-600 hover:bg-red-700 focus:outline-none active:bg-red-900 font-medium text-sm px-5 py-2.5 text-center" type="button">
                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8.6 2.6A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4c0-.5.2-1 .6-1.4ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                  </svg>                
            </button>
        </div>
    </div>
</form>


<div id="delete-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                <a href="/dashboard/product/delete/{{$product->id}}" data-modal-hide="delete-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </a>
                <button data-modal-hide="delete-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    No, cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function getImgData(inputId, previewId) {
        const chooseFile = document.getElementById(inputId);
        const imgPreview = document.getElementById(previewId);
        const files = chooseFile.files[0];
        if (files) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function () {
                imgPreview.innerHTML = '<img class="max-w-full max-h-full" src="' + this.result + '" />';
            });
        }
    }
document.addEventListener( 'DOMContentLoaded', function () {
  new Splide( '#thumbnail-carousel', {
		fixedWidth : 154,
        fixedHeight: 154,
		gap        : 10,
        snap       : false,
		rewind     : true,
		pagination : false,
  } ).mount();
} );

    images.mount();
</script>
@endsection