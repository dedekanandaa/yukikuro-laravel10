@extends('dashboard.index')

@push('splide')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
@endPush

@section('content')

<form action="/dashboard/product/edit" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-4 mx-auto">
    @csrf
    <input type="hidden" value="{{$product->id}}" name="id">
    <div>
        <label for="choose-file" class="flex-col flex hover:cursor-pointer">
            <p>Product Thumbnail</p>
            <div id="img-preview" for="choose-file" class="border-2 border-neutral-400 border-dashed rounded-md size-80 p-3">
                <img src="{{asset("storage/product/{$product->id}/{$product->thumbnail}")}}" alt="">
            </div>
            <input name="thumbnail" type="file" id="choose-file" accept="image/png, image/jpeg, image/webp" onchange="getImgData('choose-file', 'img-preview')" hidden>
        </label>

        <section class="swiper product-slider mt-3 lg:w-80">
            <div class="swiper-wrapper">
                @foreach ($image as $data)
                    <div class="swiper-slide max-h-full max-w-full object-cover">
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
                                
                                    <img src="{{asset("storage/product/{$product->id}/{$data->image}")}}" class="max-w-full max-h-full">
                                @endif
                                </div>
                            </div>
                        <input name="image[{{$data->id}}]" type="file" id="choose-file-{{$data->id}}" accept="image/png, image/jpeg, image/webp" onchange="getImgData('choose-file-{{$data->id}}', 'img-preview-{{$data->id}}')" value="null" hidden>
                        </label>
                    </div>
                @endforeach
                    <div class="swiper-slide my-auto size-6">
                        <button href="/dashboard/product/edit" class="relative left-1/2 translate-x-[-50%] rounded-full p-2 border-2 border-gray-500 text-white hover:bg-gray-100" type="submit" name="submit" value="1">
                            <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                            </svg>
                        </button>
                    </div>
                </div>
            <div class="swiper-button-next" style="color: black;"></div>
            <div class="swiper-button-prev" style="color: black;"></div>
        </section>

    </div>
    
    <div class="flex-1 grid gap-4 h-min">
        <div class="grid">
            <label for="name" class="font-bold">Product Name</label>
            <input class="font-bold" name="name" type="text" value="{{$product->name}}" placeholder="Nama Produk">
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
        <label for="visibility" class="inline-flex items-center cursor-pointer">
            <input id="visibility" name="visibility" type="checkbox" class="sr-only peer" @if ($product->visibility) checked @endif>
            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Show Product to Shop</span>
        </label>
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

<x-delete-modal>/dashboard/product/delete/{{$product->id}}</x-delete-modal>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
    var product = new Swiper(".product-slider", {
        spaceBetween: 10,
        freeMode: true,
        slidesPerView: 2.5,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
@endsection