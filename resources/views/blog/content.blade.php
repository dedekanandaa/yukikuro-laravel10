
@section('tes')
{{var_dump($data)}}
    
@endsection

@section('text-grid-1')
    <div class="grid grid-cols-{{$data->many_cols}}">
        <p class="">{{"$data->content"}}</p>
    </div>
    
@endsection
    
@section('image-grid-'.$item->many_cols)
    
    <div class="grid grid-cols-{{$item->many_cols}}">
        @php
            $filename = explode("++", $item->content)
        @endphp
        @foreach ($filename as $name)   
        <img src="/image/blog/{{ $item->id_article.'/'.$name }}" alt="">
        @endforeach

    </div>

@endsection

@section('product-grid-'.$item->many_cols)

    <div class="grid grid-cols-{{$item->many_cols}}">

    </div>

@endsection