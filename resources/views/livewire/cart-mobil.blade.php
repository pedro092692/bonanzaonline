<div class="-z-1">
    <a href="{{route('shopping-cart')}}" class="py-2 px-4 text-md flex items-center tex-gray-500 hover:text-white">
        <span class="flex justify-center w-9">
            <i class="fa-solid fa-cart-shopping text-white"></i>
        </span>
        <span class="relative inline-block cursor-pointer pr-4 ">
            @if(Cart::count())
                <span class="absolute -top-2 right-3 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ Cart::count() }}</span>
            @else
                <span class="absolute -top-2 right-3 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
            @endif  
        </span>
    </a>
</div>
