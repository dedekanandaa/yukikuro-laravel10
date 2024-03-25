@extends('dashboard/index')

@section('content')
    
    <form action="/dashboard/homepage/edit" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="1">
        <div class="flex">
            <label for="logo" class="flex flex-col hover:cursor-pointer">
                <p>Logo</p>
                <div id="imglogo" for="logo" class="border-2 border-neutral-400 border-dashed rounded-md size-18 p-3">
                    <img src="/image/home/logo.webp" alt="">
                </div>
                <input name="logo" type="file" id="logo" accept="image/png, image/jpeg, image/webp" onchange="getImgData('logo', 'imglogo')" hidden>
            </label>
            
            <div class="flex items-center space-x-3 rtl:space-x-reverse border px-8">
                <img src="/image/home/logo.webp" class="h-8" alt="logo"/>
                <span class="self-center font-mono text-2xl font-semibold whitespace-nowrap">Yuki Kuro</span>
            </div>
            <div class="flex items-center space-x-3 rtl:space-x-reverse border px-8">
                <img src="/image/home/logo.webp" class="h-8 me-3" alt="logo"/>
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">
                    Kuro Dashboard
                </span>
            </div>
            
        </div>    
        <div for="thumbnail" class="flex-col flex hover:cursor-pointer">
            <p>Homepage Thumbnail</p>
            <div id="imgthumbnail" for="thumbnail" class="border-2 border-neutral-400 border-dashed rounded-md size-80 p-3">
                <img src="/image/home/header.webp" alt="">
            </div>
            <input name="thumbnail" type="file" id="thumbnail" accept="image/png, image/jpeg, image/webp" onchange="getImgData('thumbnail', 'imgthumbnail')" hidden>
        </div>
        <label for=""></label>
        <input type="text" name="description">
        <button class="rounded-full p-2 border-2 border-gray-500 text-white hover:bg-gray-100" type="submit" name="submit" value="0">
            <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 4.7 4.5 9.3-9"/>
            </svg>
        </button>
    </form>
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
    </script>        
@endsection