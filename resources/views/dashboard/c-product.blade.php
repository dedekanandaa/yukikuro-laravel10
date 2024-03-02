@extends('dashboard.index')

@section('content')

<form action="/dashboard/product/newp" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-4 mx-auto">
    @csrf
    <div class="flex-col flex gap-3">
        <label for="thumbnail">Gambar Produk</label>
        <div id="img-preview" class="border-2 border-neutral-400 border-dashed rounded-md w-80 h-80 p-3">
            <img src="/image/BLACK BACK.png" alt="">
        </div>
        <input name="thumbnail" type="file" id="choose-file" accept="image/png, image/jpeg, image/webp">
    </div>
    <div class="grow grid gap-4 h-min">
        <div class="grid">
            <label for="name">Nama Produk</label>
            <input name="name" type="text" class="" placeholder="Nama Produk">
        </div>
        <div class="grid">
            <label for="price">Harga</label>
            <input name="price" type="number" class="" placeholder="Harga">
        </div>
        <div class="grid">
            <label for="price">Tentang Produk</label>
            <textarea name="description" placeholder="Description" rows="4"></textarea>
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