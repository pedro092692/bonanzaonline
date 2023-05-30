<x-app-layout>
    <div class="container py-8">
        @if ($products)
            @if (count($subcategories))
                <div class="py-3">
                    <p class="font-bold">Categorias:</p>
                </div>

                <ul>
                    @forelse($subcategories as $subcategory)
                        <a href="{{ route('categories.show', $subcategory->category->slug) . '?subcategory_select=' . $subcategory->slug }}"
                            class="flex hover:text-blue-500">
                            <div class="text-gray-700 ml-4 py-2 border-b w-full">
                                <p class="text-lg leading-5 font-semibold ">{{ $subcategory->name }}</p>
                            </div>
                        </a>
                    @empty
                    @endforelse
                </ul>
            @endif

            @if (count($products))
                <div class="py-3">
                    <p class="font-bold">Productos:</p>
                </div>
            @endif
            <ul>
                @forelse($products as $product)
                    <x-product-list :product="$product">
                    </x-product-list>
                @empty
                    <li class="bg-white rounded-lg shadow-lg">
                        <div class="p-4">
                            <p class="text-lg text-gray-700 text-center font-semibold"> No encontramos lo que estas
                                buscando 😢 </p>
                        </div>
                    </li>
                @endforelse
            </ul>

            <div class="mt-4">
                {{ $products->links('paginate.show') }}
            </div>
        @else
            <div class="p-4 bg-white rounded-lg shadow-lg">
                <p class="text-lg text-gray-700 text-center font-semibold"> No encontramos lo que estas
                    buscando 😢 </p>
            </div>
        @endif


    </div>
</x-app-layout>
