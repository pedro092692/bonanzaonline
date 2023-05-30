<div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="bg-white rounded-lg shadow-lg px-12 py-8 mb-6 flex items-center">
            
            <div class="relative">
                <div class="{{ ($order->status >=2 && $order->status != 5 && $order->status != 6) ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  items-center flex justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="absolute -left-1.5 mt-0.5">
                    <p>Recibido</p>
                </div>
            </div>

            <div class="{{ ($order->status >=3 && $order->status != 5 && $order->status != 6) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

            <div class="relative">
                <div class="{{ ($order->status >=3 && $order->status != 5 && $order->status != 6) ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  items-center flex justify-center">
                    <i class="fas fa-truck text-white"></i>
                </div>
                <div class="absolute -left-1 mt-0.5">
                    <p>Enviado</p>
                </div>
            </div>

            <div class="{{ ($order->status >=4 && $order->status != 5 && $order->status != 6) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

            <div class="relative">
                <div class="{{ ($order->status >=4 && $order->status != 5 && $order->status != 6) ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  items-center flex justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="absolute -left-2 mt-0.5">
                    <p>Entregado</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
            <p class="text-gray-700 uppercase"> <span class="font-bold">Número de orden:</span>
                Orden-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>

                <form wire:submit.prevent="update">
                    <div class="flex space-x-3 mt-2">
                        <x-label>
                            <input wire:model="status" type="radio" name="status" value="6" class="mr-2">
                            REVISANDO
                        </x-label>
                        
                        <x-label>
                            <input wire:model="status" type="radio" name="status" value="2" class="mr-2">
                            RECIBIDO
                        </x-label>
                        <x-label>
                            <input wire:model="status" type="radio" name="status" value="3" class="mr-2">
                            ENVIADO
                        </x-label>
                        <x-label>
                            <input wire:model="status" type="radio" name="status" value="4" class="mr-2">
                            ENTREGADO
                        </x-label>
                        <x-label>
                            <input wire:model="status" type="radio" name="status" value="5" class="mr-2">
                            ANULADO
                        </x-label>
                    </div>

                    <div class="flex mt-2">
                        <x-button class="ml-auto">
                            Actualizar
                        </x-button>
                    </div>
                </form>
        </div>
        @if (count($bankTransferOrder))
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase mb-4"> <span class="font-bold">Informacion de orden:</span>
                <div class="grid grid-cols-4 gap-6 text-gray-700">
                
                    <div>
                        <p class="text-lg uppercase underline">Numero de referencia</p>
                        <p class="text-lg font-semibold"> {{$order->bankTransfer->reference}}</p>
                    </div>

                    <div>
                        <p class="text-lg uppercase underline">comprobante de pago</p>

                            <div id="lightgallery">
                                <a href="{{Storage::url($order->bankTransfer->image)}}" data-lightbox="image-1" data-title="Captura de pantalla"><img class="w-20 h-20 object-center object-cover" src="{{Storage::url($order->bankTransfer->image)}}" alt="Gallery image 1" /></a>

                            </div>
                    </div>

                    <div>
                        <p class="text-lg uppercase underline">Monto</p>
                        <p class="text-lg font-semibold"> {{$order->bankTransfer->amount}}</p>
                    </div>

                    <div>
                        <p class="text-lg uppercase underline">Fecha</p>
                        <p class="text-lg font-semibold"> {{$order->bankTransfer->created_at->format('d-m-y')}}</p>
                    </div>
                </div>
                
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-6 text-gray-700">
                <div>
                    <p class="text-lg font-semibold uppercase">Envío</p>

                    @if ($order->shipping_type == 1)
                        <p class="text-sm">Los productos deben ser recogidos en tienda:</p>
                        <p class="text-sm">(Fake street 123)</p>
                    @else
                        <p class="text-sm">Los productos serán enviados a la siguiente dirección:</p>
                        <p class="text-sm font-semibold">{{ $shipping->address }}</p>
                        <p class="text-sm">{{ $shipping->department}} - {{ $shipping->city }} -
                            {{ $shipping->district }}</p>
                    @endif
                </div>

                <div>
                    <p class="text-lg font-semibold uppercase">Datos de contacto</p>
                    <p class="text-sm">Persona que recibirá la orden: {{ $order->contact }}</p>
                    <p class="text-sm">Telefono de contacto: {{ $order->phone }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
            <p class="text-xl font-semibold mb-4">
                Resumen
            </p>
            <div class="{{ count($elements) > 6 ? 'overflow-y-auto h-96' : '' }}">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Precio</th>
                            <th>Cant</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="flex">
                                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
                                            alt="{{ $item->name }}" title="{{ $item->name }}">
                                        <article>
                                            <h1 class="font-bold">
                                                {{ $item->name }}
                                            </h1>
                                            <div class="flex text-xs">
                                                @isset($item->options->color)
                                                    Color: {{ __($item->options->color) }}
                                                @endisset
                                                @isset($item->options->size)
                                                    - Talla: {{ __($item->options->size) }}
                                                @endisset
                                                @isset($item->options->weight)
                                                    Peso: {{ __($item->options->weight) }}
                                                @endisset
                                            </div>
                                        </article>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ $item->price }} USD
                                </td>
                                <td class="text-center">
                                    {{ $item->qty }}
                                </td>
                                <td class="text-center">
                                    {{ $item->price * $item->qty }} USD
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    @push('script')
    <script>
        lightbox.option({
          'resizeDuration': 200,
          'wrapAround': true
        })
    </script>
    @endpush
</div>
