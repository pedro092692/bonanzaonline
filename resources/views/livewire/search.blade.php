<div class="flex-1 relative" style="z-index: 10" x-data>
    <form action="{{route('search')}}" autocomplete="off">
        <x-input name="name" wire:model="search" type="text" class="w-full" placeholder="Que estas buscando &#xF002;" style="font-family:Arial, FontAwesome" />
    
        <button class="absolute top-0 right-0 w-12 h-full bg-green-700 flex items-center justify-center rounded-r-md">
            <x-search size="35" color="white" />
        </button>
    </form>

    <div class="absolute w-full hidden" :class="{ 'hidden' : !$wire.open }" 
        @click.away="$wire.open = false"
        >
        <div class="bg-white rounded-lg shadow mt-1">
            <div class="px-4 py-3 space-y-3 divide-y">   
                @if (count($subcategories))
                    <p class="mb-4 font-bold">Categorias:</p>
                @endif
                @foreach ($subcategories as $subcategory)
                    <a href="{{route('categories.show', $subcategory->category->slug) .'?subcategory_select='. $subcategory->slug}}" class="flex">  
                        <div class="text-gray-700 ml-4 py-2">
                            <p class="text-lg leading-5 font-semibold">{{$subcategory->name }} - <span class="text-sm italic text-gray-500">{{$subcategory->category->name }}</span></p>
                        </div>
                    </a>
                @endforeach
                
                @if (count($products))
                <div class="py-3">
                    <p class="font-bold">Productos:</p>
                </div>
                @endif
                @forelse ($products as $product)
                <div>
                    <a href="{{route('products.show', $product)}}" class="flex">
                        <img class="w-16 h-12 object-cover" src="{{ Storage::url($product->images->first()->url) }}" alt="">

                        <div class="text-gray-700 ml-4 py-2">
                            <p class="text-lg leading-5 font-semibold">{{$product->name }}</p>
                            <p>Categoria: {{ $product->subcategory->category->name }}</p>
                        </div>
                    </a>
                </div>
                @empty
                    @if (!count($subcategories) && !count($products))
                        <p class="text-lg leading-5 text-center p-3">No encontramos lo que estas buscando 😢</p>
                    @endif
                    
                @endforelse

            </div>
        </div>
    </div>
</div>
