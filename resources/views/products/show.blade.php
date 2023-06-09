<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            {{-- slider --}}
            <div>
                <div class="flexslider">
                    <ul class="slides">
                        @foreach ($product->images as $image)
                            <li data-thumb="{{ Storage::url($image->url) }}">
                                <img src="{{ Storage::url($image->url) }}"
                                    class="aspect-square object-cover object-center" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- product info --}}
            <div class="-mt-10 md:mt-0">
                <h1 class="text-xl font-bold text-gray-700">{{ $product->name }}</h1>
                <div class="flex">
                    <p class="text-gray-700">Marca: <a href=""
                            class="underline capitalize hover:text-green-700">{{ $product->brand->name }}</a></p>
                    <p class="text-gray-700 mx-6">{{round($product->reviews->avg('rating'), 2)}}<i class="fas fa-star text-sm text-yellow-500"></i></p>
                    <a href="" class="text-green-600 underline hover:text-green-800">{{$product->reviews->count()}} Calificaciones</a>
                </div>
            {{-- product price --}}
                <p class="font-bold text-2xl text-gray-700 my-4">USD {{ $product->price }}</p>

                <div class="bg-white rounded-lg shadow-lg mb-6">
                    <div class="p-4 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-orange-600">
                            <i class="fas fa-truck text-sm text-white"></i>
                        </span>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-green-700">Se hacen envios a todo Maracay</p>
                            <p>Recíbelo el {{ Carbon::now()->addDay(1)->locale('es')->format('l j F') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg text-gray-700 shadow-lg mb-6 p-4">
                    <h2 class="font-bold">Descripcion</h2>
                    <hr class="my-2">
                    <p class="text-dm">{!! $product->description !!}</p>
                </div>


                @if ($product->subcategory->size)
                    @livewire('add-cart-item-size', ['product' => $product])
                @elseif($product->subcategory->color)
                    @livewire('add-cart-item-color', ['product' => $product])
                @elseif($product->subcategory->weight)
                    @livewire('add-cart-item-weight', ['product' => $product])
                @else
                    @livewire('add-cart-item', ['product' => $product])
                @endif

                {{-- product review --}}
                @can('review', $product)
                    <div class="text-gray-700 mt-6">
                        <h2 class="font-bold text-lg">Dejar una resena</h2>

                        <form action="{{ route('reviews.store', $product) }}" method="POST">
                            @csrf
                            <textarea id="editor" name="comment"></textarea>
                            <x-input-error for="comment" />
                            <div class="flex flex-wrap sm:flex items-center mt-2" x-data="{rating: 5}">
                                <p class="font-semibold mr-3">Calificacion:</p>
                                <ul class="flex space-x-2">
                                    <li :class="rating >=1 ? 'text-yellow-500' : ''">
                                        <button type="button" class="focus:outline-none" x-on:click="rating = 1">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li :class="rating >=2 ? 'text-yellow-500' : ''">
                                        <button type="button" class="focus:outline-none" x-on:click="rating = 2">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li :class="rating >=3 ? 'text-yellow-500' : ''">
                                        <button type="button" class="focus:outline-none" x-on:click="rating = 3">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li :class="rating >=4 ? 'text-yellow-500' : ''">
                                        <button type="button" class="focus:outline-none" x-on:click="rating = 4">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li :class="rating >=5 ? 'text-yellow-500' : ''">
                                        <button type="button" class="focus:outline-none" x-on:click="rating = 5">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                </ul>
                                <input type="number" name="rating" x-model="rating" class="hidden">

                                <x-button class="w-full mt-2 sm:text-right sm:mt-0 sm:w-auto sm:ml-auto">
                                    Agregar resena
                                </x-button>
                            </div>
                        </form>
                    </div>
                @endcan

                @if ($product->reviews->isNotEmpty())
                    <div class="mt-6 text-gray-700">
                        <h2 class="font-bold text-lg">Resenas</h2>
                        <div class="mt-2">
                            @foreach ($product->reviews as $review)
                                <div class="flex mt-2">
                                    <div class="flex-shrink-0">
                                        <img class="w-10 h-10 rounded-full mr-4 object-cover" src="{{$review->user->profile_photo_url}}" alt="{{$review->user->name}}">
                                    </div>
                                    
                                    <div class="flex-1">
                                        <p class="font-semibold">{{$review->user->name}}</p>
                                        <p class="text-sm">{{$review->created_at->diffForHumans()}}</p>
                                        <div>
                                            {!! $review->comment !!}
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <p>
                                            {{$review->rating}}
                                            <i class="fas fa-star text-yellow-500"></i>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @push('script')
        <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

        <script>
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote', 'link']
                })
                .catch(error => {
                    console.log(error);
                });
        </script>

        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    rtl: true
                });
            });
        </script>
    @endpush
</x-app-layout>
