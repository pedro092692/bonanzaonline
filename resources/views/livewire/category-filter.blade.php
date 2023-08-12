<div>
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="flex px-6 py-2 justify-between items-center">
            <h1 class="font-semibold text-gray-700 uppercase">
                {{ $category->name }}
            </h1>
            <div class="hidden md:block grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500">
                <i class="fas fa-border-all p-3 cursor-pointer  {{ $view == 'grid' ? 'text-green-500' : '' }}"
                    wire:click="$set('view', 'grid')"></i>
                <i class="fas fa-th-list p-3 cursor-pointer  {{ $view == 'list' ? 'text-green-500' : '' }}"
                    wire:click="$set('view', 'list')"></i>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <aside class="flex flex-col">
            <h2 class="font-semibold text-center mb-2">Subcategorías</h2>
            <ul class="divide-y divide-gray-200">
                
                @foreach ($category->subcategories as $subcategory)
                    <li
                        wire:click="{{$subcategory_select && $subcategory_select == $subcategory->slug ? "clean_subcategory" : "\$set('subcategory_select', '$subcategory->slug')"}}"
                        class="py-2 text-sm cursor-pointer hover:text-green-700 capitalize {{ $subcategory_select == $subcategory->slug ? 'text-blue-700 font-semibold' : '' }}">
                        <a>
                            {{ $subcategory->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <h2 class="font-semibold text-center mt-4 mb-2">Marcas</h2>
            <ul class="divide-y divide-gray-200">
                @foreach ($category->brands as $brand)
                    <li
                        wire:click="{{$brand_select && $brand_select == $brand->name ? "clean_brand" : "\$set('brand_select', '$brand->name')"}}"
                        class="py-2 text-sm cursor-pointer hover:text-green-700 capitalize {{ $brand_select == $brand->name ? 'text-blue-700 font-semibold' : '' }}">
                        <a>
                            {{ $brand->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <x-button class="mt-4 m-auto" wire:click="clean">
                Eliminar Filtros
            </x-button>
        </aside>

        <div class="md:col-span-2 lg:col-span-4">
            
            @if (!count($products))
                <div class="bg-white rounded-md shadow-md p-4 flex justify-center">                 
                    <p class="font-semibold text-gray-700 text-xl">No hay ningun producto con los filtros aplicados 😕</p>      
                </div>
            @else
                {{-- grip --}}
                @if ($view == 'grid')
                    <ul class="grid grid-cols-1 md:grid-cols-2  lg:grid-cols-4 gap-6">
                        @foreach ($products as $product)
                            <li class="bg-white rounded-lg shadow">
                                <article>
                                    <figure>
                                        @if (isset($product->images->first()->url))
                                        <a href="{{ route('products.show', $product) }}">
                                            <img src="{{ Storage::url($product->images->first()->url) }}" alt="" class="h-48 w-full object-cover object-center">
                                        </a>
                                        @else
                                            <img src="{{ asset('images/no_available_image.png') }}" alt="" class="h-48 w-full object-cover object-center">
                                        @endif
                                    </figure>
                                    <div class="py-4 px-6">
                                        <a href="{{ route('products.show', $product) }}">
                                            <h1 class="text-lg font-semibold">
                                                    {{ Str::limit($product->name, 20) }}
                                            </h1>
                                            @if (isset($dollar_value->value))
                                                <p class="font-bold text-gray-700">US$ {{$product->price}} / {{ round($product->price * $dollar_value->value, 2) }} Bs </p>
                                            @else
                                                <p class="font-bold text-gray-700">US$ {{$product->price}} </p>
                                            @endif
                                        </a>    
                                    </div>
                                </article>
                            </li>
                        @endforeach
                    </ul>
                    {{-- list --}}
                @else
                    <ul>
                        @foreach ($products as $product)
                            <x-product-list :product="$product">
                            </x-product-list>
                        @endforeach
                    </ul>
                @endif
            
            @endif
            <div class="mt-4" wire:ignore>
                {{ $products->links('paginate.show') }}
                {{-- {{ $products->links('paginate.show') }} --}}
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        function top_zero() {
            document.body.scrollTop = document.documentElement.scrollTop = 0;
        }
    </script>
@endpush
