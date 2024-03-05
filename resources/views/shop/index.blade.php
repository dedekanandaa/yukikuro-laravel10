@extends('index')
@section('konten')
    <main class="mx-auto max-w-screen-xl md:w-10/12 md:pt-10 flex-1">
            
        <x-product :product="$product"></x-product>
        
    </main>
@endsection
