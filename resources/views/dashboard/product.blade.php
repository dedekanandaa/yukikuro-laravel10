@extends('dashboard.index')

@section("content")
<div class="flex justify-between items-center">
    <p class="font-bold text-2xl">Daftar Produk</p>
    <div>
        <a href="/dashboard/product/new" class="bg-white p-3 border-2 flex right-12 bottom-7 rounded-md items-center gap-3 ">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-4 w-4 text-neutral-200">
            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
            </svg>
            New Product
        </a>
    </div>
</div>

<div class="relative overflow-x-auto mt-5">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Stock
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $item)

            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" ondblclick="window.location = ('/dashboard/product/edit/{{$item->id}}')">
                <td scope="row" >
                    <img src="/image/product/{{$item->id . '/' .$item->thumbnail}}" class="w-16">
                </td>
                <td class="px-6 py-4">
                    {{$item->name}}
                </td>
                <td class="px-6 py-4">
                    {{$item->description}}
                </td>
                <td class="px-6 py-4">
                    {{'Rp. '.number_format($item->price, 0,',', '.')}}
                </td>
                <td class="px-6 py-4">
                    <table>
                        @foreach ($stock as $data)
                        @if ($data->id_product == $item->id)

                        <tr>
                            <td>{{$data->size}}</td>
                            <td> =  </td>
                            <td>{{$data->qty . ' pcs'}}</td>
                        </tr>
                            
                        @endif
                        @endforeach
                    </table>
                </td>
                <td class="px-6 py-4">
                    <button class="">edit</button>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>


@endsection