@extends('dashboard.index')

@section('content')

<form action="/dashboard/product/edit" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-4 mx-auto">
    @csrf
    <input type="hidden" value="{{$product->id}}" name="id">
    <div class="space-y-5">
        <label for="choose-file" class="flex-col flex gap-3 hover:cursor-pointer">
            <p class="font-bold">Product Thumbnail</p>
            <div id="img-preview" for="choose-file" class="border-2 border-neutral-400 border-dashed rounded-md size-80 p-3">
                <img src="/image/product/{{$product->id .'/'. $product->thumbnail}}" alt="">
            </div>
            <input name="thumbnail" type="file" id="choose-file" accept="image/png, image/jpeg, image/webp" hidden>
        </label>
        <label for="product-image" class="flex-col flex gap-3 mt-3">
            <p class="font-bold">Product Picture</p>
            <input name="images" type="file" id="product-image" accept="image/png, image/jpeg, image/webp" multiple>
        </label>

        <button data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none active:bg-red-900 font-medium text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            Delete Product
        </button>
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
    </div>
    
    <div class="grow grid gap-4 h-min">
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

        @empty($stock[0]->size)
            
        <div class="grid" id="size-form-1">
            <p>Stock</p>
            <input type="hidden" name="id_stock" value="{{$stock[0]->id}}">
            <input type="number" name="qty" value="{{$stock[0]->qty}}" placeholder="Stock">
        </div>
        
        @endempty
        
        @empty(!$stock[0]->size)
        
        <div class="grid gap-3" id="size-form-2">
            <p>Stock Size</p>
            @foreach ($stock as $key => $item)
            <input type="hidden" name="id_stock_{{$key}}" value="{{$item->id}}">
            <input type="number" name="qty_{{$key}}" value="{{$item->qty}}" placeholder="{{$item->size}}">
            @endforeach
        </div>  

        @endempty
        <div class="flex gap-3 items-center"> 
            <input type="checkbox" id="visibility" name="visibility" @if ($product->visibility) checked @endif >
            <label for="visibility">Show Product in Shop</label>
        </div>
        <button type="submit" class="bg-neutral-800 py-2 text-white hover:bg-neutral-900">OK</button>
    </div>
</form>

    <script>
    const chooseFile = document.getElementById("choose-file");
    const imgPreview = document.getElementById("img-preview");
    
    chooseFile.addEventListener("change", function () {
      getImgData();
    });
    
    function getImgData() {
      const files = chooseFile.files[0];
      if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
          imgPreview.style.display = "block";
          imgPreview.innerHTML = '<img class="my-auto" src="' + this.result + '" />';
        });    
      }
    }
    </script>
@endsection