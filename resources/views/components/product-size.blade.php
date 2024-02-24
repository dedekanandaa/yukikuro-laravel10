<li>
    <input type="radio" id="{{'size-'.$slot}}" name="size" value="{{$slot}}" class="hidden peer" required @if ($qty == 0) disabled @endif/>
    <label for="{{'size-'.$slot}}" class="flex px-4 py-2 text-neutral-500 bg-white border border-neutral-400 cursor-pointer peer-checked:border-black peer-checked:text-black hover:text-gray-600 peer-checked:bg-neutral-100 hover:bg-neutral-100 peer-disabled:border-red-300 peer-disabled:cursor-not-allowed peer-disabled:hover:bg-white peer-disabled:text-neutral-300">                           
        {{$slot}}
    </label>
</li>