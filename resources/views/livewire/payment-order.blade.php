<div>
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-5 gap-6 container py-8">

        <div class="order-2 lg:order-1 xl:col-span-3">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase"> <span class="font-bold">Número de orden:</span>
                    Orden-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>

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
                            <p class="text-sm">{{ $shipping->department }} - {{ $shipping->city }} -
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
                                            <img class="hidden sm:block h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
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
                                        {{ round($item->price, 2) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->qty }}
                                    </td>
                                    <td class="text-center">
                                        {{ round($item->price * $item->qty,2) }} USD
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
        <div class="order-1 lg:order-2 xl:col-span-2">
            <div class="bg-white rounded-lg shadow-lg px-6 pt-6 py-4">
                <div class="md:flex justify-between items-center mb-6">
                    <img class="m-auto mb-4 h-12 md:" src="{{ asset('images/Credit-Card-Icons.png') }}" alt="">

                    <div class="text-gray-700">
                        <p class="text-sm font-semibold">Subtoal: {{ $order->total - $order->shipping_cost }} USD</p>
                        <p class="text-sm font-semibold">Envio: {{ $order->shipping_cost }} USD</p>
                        <p class="text-lg font-semibold">Total: {{ $order->total }} USD</p>
                    </div>
                </div>

                {{-- payments methods --}}

                {{-- paypal --}}

                {{-- <div class="bg-white rounded-lg shadow mb-4">
                    <label class="px-6 py-4 flex items-center cursor-pointer">
                        <input wire:model="payment_method" type="radio" name="payment_method" value="2"
                            class="text-gray-600">

                        <span class="ml-2 text-gray-700">Tarjeta de credito</span>
                    </label>
                </div>

                <div id="credit_card" class="{{ $payment_method !=2 ? 'hidden': '' }}">
                    <div wire:ignore id="paypal-button-container"></div>
                </div> --}}
                
                {{-- bank transfer --}}

                <div class="bg-white rounded-lg shadow">
                    <label class="px-6 py-4 flex items-center cursor-pointer">
                        <input wire:model="payment_method" type="radio" name="payment_method" value="1"
                            class="text-gray-600">

                        <span class="ml-2 text-gray-700">Transferencia Bancaria</span>
                    </label>
                </div>

                <div class="{{ $payment_method !=1 ? 'hidden': '' }}">
                    <div class="mt-2 bg-white rounded-lg shadow px-6 py-4">
                        <p class="text-lg font-semibold uppercase text-center">Datos de transferencia</p>
                        
                        <div class="mt-4 mb-4">
                            <label class="block mb-2  font-medium text-gray-900 ">Numero de cuenta:</label>
                            <div class="flex">
                                <p>01340154331541014489</p> 
                                <button x-data="{ accunt: '01340154331541014489' }" class="js-copy-to-clip ml-3">
                                    <i x-clipboard="accunt" class="fa-solid fa-copy"></i>
                                </button>
                            </div>

                            <label class="mt-4 block mb-2  font-medium text-gray-900 ">Razon social:</label>
                            <div class="flex">
                                <p>Bonanzasrl</p> 
                                <button x-data="{ name: 'bonanzasrl' }" class="js-copy-to-clip ml-3">
                                    <i  x-clipboard="name" class="fa-solid fa-copy"></i>
                                </button>
                            </div>

                            <label class="mt-4 block mb-2  font-medium text-gray-900 ">RIF:</label>
                            <div class="flex">
                                <p>J-302843120</p> 
                                <button x-data="{ rif: '302843120' }" class="js-copy-to-clip ml-3">
                                    <i  x-clipboard="rif" class="fa-solid fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        @if (isset($dollar_value->value))
                            <label class="font-bold">Total a pagar: {{ round($order->total * $dollar_value->value, 2)}} Bs</label>
                        @else
                            <label class="font-bold">Total a pagar: {{ $order->total }} USD </label> - Tasa BCV
                        @endif
                        
                    

                        <label class="mt-4 block mb-2  font-medium text-gray-900 ">Concepto de transferencia: </label>
                        <div class="flex mt-4">
                            <p><span class="text-sm font-bold">Pago orden {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span></p> 
                            
                            <button class="js-copy-to-clip ml-3" x-data="{ concept: 'pago orden ' + {{ strval(str_pad($order->id, 6, '0', STR_PAD_LEFT)) }} }" >
                                <i x-clipboard="concept" class="fa-solid fa-copy"></i>
                            </button>
                        </div>

                        <div class="mt-4" x-data>

                            <form wire:submit.prevent="bankTransfer">
                                <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Numero de referencia</label>
                                <input type="text" wire:model="paymentForm.reference"  x-mask="9999" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="4 ultimos nros de referencia Ej: 1234">
                                <x-input-error for="paymentForm.reference" />
                                </div>
                                <div class="mb-6">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Recibo de transferencia</label>
                                <input type="file" wire:model="paymentForm.receipt" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <x-input-error for="paymentForm.receipt" />
                                </div>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Subir Pago</button>
                            </form>
                        </div>
  

                    </div>
                    {{-- <p class="mr-4">Pagar con banesco pagos</p>
                    <p>Subtotal: {{ round( ($order->total - $order->shipping_cost) * $dollar_value->value, 2)}}</p>
                    <p>Envio: {{ round($order->shipping_cost * $dollar_value->value, 2)}} </p>
                    <p>Total a pagar {{ round($order->total * $dollar_value->value, 2)}}</p> --}}
                </div>


            </div>
        </div>

    </div>
    @push('script')

    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>


    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: "{{ $order->total }}"
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    //livewire event
                    Livewire.emit('payOrder');
                });
            }
        }).render("#paypal-button-container");
    </script>
@endpush




</div>


