@extends('dashboard.index')

@section('content')

<form action="/dashboard/product/newp" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-4 mx-auto">
    @csrf
    <label for="choose-file" class="flex-col flex gap-3 hover:cursor-pointer">
        <p class="font-bold">Product Thumbnail</p>
        <div id="img-preview" class="border-2 border-neutral-400 border-dashed rounded-md size-80 p-3 place-content-center place-items-center grid">
            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
        </div>
        <input name="thumbnail" type="file" id="choose-file" accept="image/png, image/jpeg, image/webp">
    </label>
    <div class="grow grid gap-4 h-min">
        <div class="grid">
            <label for="name">Product Name</label>
            <input name="name" type="text" class="" placeholder="Nama Produk">
        </div>
        <div class="grid">
            <label for="price">Price</label>
            <input name="price" type="number" class="" placeholder="Harga">
        </div>
        <div class="grid">
            <label for="price">Description</label>
            <textarea name="description" placeholder="Description" rows="4"></textarea>
        </div>
          <div class="flex gap-3 items-center"> 
              <input id="has-size" type="checkbox" name="hassize">
              <label for="has-size">This product has size?</label>
          </div>
        <div class="grid " id="size-form-1">
          <label for="">Stock</label>
          <input type="number" name="qty" placeholder="Stock">
        </div>
        <div class="grid gap-3 hidden" id="size-form-2">
            <label for="">Stock Size</label>
            <input type="number" name="qty_0" placeholder="S">
            <input type="number" name="qty_1" placeholder="M">
            <input type="number" name="qty_2" placeholder="L">
            <input type="number" name="qty_3" placeholder="XL">
            <input type="number" name="qty_4" placeholder="XXL">
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