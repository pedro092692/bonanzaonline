<x-app-layout>
    <div class="container py-8">
        @foreach ($categories as $category)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="text-lg uppercase text-gray-700 font-semibold">
                        {{ $category->name }}
                    </h1>

                    <a href="{{route('categories.show', $category)}}" class="text-green-700 ml-2 font-semibol hover:text-green-500 hover:underline">Ver más</a>
                </div>
                @livewire('category-products', ['category' => $category])
            </section>
        @endforeach
        
        <h2 class="text-md text-justify text-gray-700 mt-4">Bienvenido a Bonanza Online, tu destino en línea para disfrutar de una amplia variedad de frutas frescas y deliciosas. En Bonanza Online, nos apasiona proporcionar a nuestros clientes productos de alta calidad, directamente desde los mejores campos.</h2>
        
    </div>

    @push('script')
        <script>
            
            Livewire.on('glider', function(id){
                new Glider(document.querySelector('.glider-'+id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-'+id+'~ .dots',
                    arrows: {
                        prev: '.glider-'+id+'~ .glider-prev',
                        next: '.glider-'+id+'~ .glider-next'
                    },
                    responsive: [
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            }
                        },
                    ]
                });
            });
        </script>
    @endpush

</x-app-layout>
