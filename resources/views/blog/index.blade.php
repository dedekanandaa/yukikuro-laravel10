@extends('index')

@section('konten')
<main class="max-w-screen-xl md:w-10/12 mx-auto flex-1">
    
<x-article :article="$article"></x-article>

</main>
@endsection