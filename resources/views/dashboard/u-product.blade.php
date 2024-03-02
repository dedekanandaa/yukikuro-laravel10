@extends('dashboard.index')

@section('content')

<form action="/dashboard/product/edit" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-4 mx-auto">
    @csrf
    <div>
        <div class="flex-col flex gap-3">
                <label for="choose-file">Thumbnail</label>
                <label id="img-preview" for="choose-file" class="border-2 border-neutral-400 border-dashed rounded-md w-80 h-80 p-3">
                    <img src="/image/product/{{$product->id .'/'. $product->thumbnail}}" alt="">
                </label>
                <input name="thumbnail" type="file" id="choose-file" accept="image/png, image/jpeg, image/webp">
        </div>
        <div class="flex-col flex gap-3 mt-3">
                <label for="choose-file">Product Picture</label>
                <input name="images" type="file" id="choose-file" accept="image/png, image/jpeg, image/webp" multiple>
        </div>
        
    </div>
    
    <div class="grow grid gap-4 h-min">
        <div class="grid">
            <label for="name">Nama Produk</label>
            <input name="name" type="text" value="{{$product->name}}" placeholder="Nama Produk">
        </div>
        <div class="grid">
            <label for="price">Harga</label>
            <input name="price" type="number" value="{{$product->price}}" placeholder="Harga">
        </div>
        <div class="grid">
            <label for="price">Tentang Produk</label>
            <textarea name="description" placeholder="Description" rows="4">{{$product->description}}</textarea>
        </div>
        <div class="grid grid-cols-2">
            <div class="flex gap-3 items-center"> 
                <input id="has-size" type="checkbox" name="hassize">
                <label for="has-size">This product has size?</label>
            </div>
            <div class="flex gap-3 items-center"> 
                <input type="checkbox" id="visibility" name="visibility">
                <label for="visibility">Show This Product?</label>
            </div>
        </div>
        <div class="grid " id="size-form-1">
            <label for="">Stock Barang</label>
            <input type="number" name="qty" placeholder="Stock">
        </div>
        <div class="grid hidden" id="size-form-2">
            <label for="">Stock Size</label>
            <input type="number" name="qty-s" placeholder="S">
            <input type="number" name="qty-m" placeholder="M">
            <input type="number" name="qty-l" placeholder="L">
            <input type="number" name="qty-xl" placeholder="XL">
            <input type="number" name="qty-xxl" placeholder="XXL">
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
    <script>
    const hasSize = document.getElementById("has-size");
    const sizeForm1 = document.getElementById("size-form-1");

    hasSize.addEventListener("change", (function() {
            if (hasSize.checked) {
                document.getElementById('size-form-2').classList.remove("hidden")
                document.getElementById('size-form-1').classList.add("hidden")
            } else {
                document.getElementById('size-form-1').classList.remove("hidden")
                document.getElementById('size-form-2').classList.add("hidden")

            }
        })
    )
    </script>
@endsection