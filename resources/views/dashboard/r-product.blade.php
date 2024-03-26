@extends('dashboard.index')

@section("content")
<div class="flex justify-between items-center">
    <p class="font-bold text-2xl">Product List
    </p>
    <div>
        <a href="/dashboard/product/new" class="bg-white p-3 border-2 flex right-12 bottom-7 rounded-md items-center gap-3 ">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-4 w-4 text-gray-200">
            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
            </svg>
            New Product
        </a>
    </div>
</div>

<div class="relative overflow-x-auto mt-5">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="text-center">
                <th class="border py-3 w-36">
                    Image
                </th>
                <th class="border py-3">
                    Product
                </th>
                <th class="border py-3">
                    Stock
                </th>
                <th class="border py-3">
                    Visible
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($product as $item)

            <tr class="bg-white border-b hover:cursor-pointer hover:bg-gray-50" onclick="window.location = ('/dashboard/product/edit/{{$item->id}}')">
                <td>
                    <img src="{{asset("storage/product/{$item->id}/{$item->thumbnail}")}}" class="h-36">
                </td>
                <td class="px-6 py-4">
                    <p class="font-bold">{{$item->name}}</p>
                    <p>{{'Rp. '.number_format($item->price, 0,',', '.')}}</p>
                    <p>{{$item->description}}</p>
                </td>    
                <td>
                    <table class="mx-auto">
                        @foreach ($stock as $data)
                        <tr>
                            @if ($data->id_product == $item->id)
                            @empty(!$data->size)
                            
                            <td class="text-end">{{$data->size}} </td>
                            <td class="text-center"> = </td>
                            
                            @endempty
                            
                            <td class="text-end min-w-full">{{$data->qty}}</td>
                            
                            @endif
                        </tr>
                            @endforeach

                    </table>
                </td>
                <td class="text-center">

                    @if ($item->visibility)
                    <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        <svg class="size-4 text-green-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4 6-9 6s-9-4.8-9-6c0-1.2 4-6 9-6s9 4.8 9 6Z"/>
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </span>
                    @else
                    <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        <svg class="size-4 text-red-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 14c-.5-.6-.9-1.3-1-2 0-1 4-6 9-6m7.6 3.8A5 5 0 0 1 21 12c0 1-3 6-9 6h-1m-6 1L19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </span>
                    @endif 

                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
</div>


@endsection