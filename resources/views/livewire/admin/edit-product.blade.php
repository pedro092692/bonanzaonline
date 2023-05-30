<div>

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between item-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                   Productos 
                </h1>
                <x-danger-button
                                wire:click="$emit('deleteProduct')">
                    Eliminar producto
                </x-danger-button>
            </div>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
        <h1 class="text-3xl text-center font-semibold mb-8">Complete esta información para Editar este producto</h1>

        <div class="mb-4" wire:ignore>
            <form action="{{ route('admin.products.files', $product) }}" method="POST" class="dropzone"
                id="my-awesome-dropzone"></form>
        </div>

        @if ($product->images->count())
            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                <h1 class="text-2xl text-center font-semibold mb-2">Imagenes del producto</h1>
                <ul class="flex flex-wrap">
                    @foreach ($product->images as $image)
                        <li class="relative" wire:key="image-{{ $image->id }}">
                            <img src="{{ Storage::url($image->url) }}" alt="product-image"
                                class="mr-2 aspect-square w-32 h-30 object-cover">
                            <x-danger-button class="absolute right-3 top-2 w-3 h-2"
                                wire:click="deleteImage({{ $image->id }})" wire:loading.attr="disabled"
                                wire:target="deleteImage({{ $image->id }})">
                                x
                            </x-danger-button>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        @livewire('admin.status-product', ['product' => $product], key('status-product-' . $product->id))


        <div class="mx-auto grid grid-cols-2 gap-6 bg-white  py-8 px-4">
            {{-- category --}}
            <div>
                <x-label value="Categorías" />
                <select class="w-full form-control" wire:model="category_id">
                    <option value="" selected disabled>Seleciona una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="category_id" />
            </div>
            {{-- subcategory  --}}
            <div>
                <x-label value="Subcategorías" />
                <select class="w-full form-control" wire:model="product.subcategory_id">
                    <option value="" selected disabled>Seleciona una subcategoría</option>
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="product.subcategory_id" />
            </div>
        </div>
        <div class="mx-auto bg-white shadow-lg rounded py-8 px-4">
            {{-- product name --}}
            <div class="mb-4">
                <x-label value="Nombre" />
                <x-input type="text" placeholder="Ingresa el nombre del producto" class="w-full"
                    wire:model="product.name" />
                <x-input-error for="product.name" />
            </div>
            {{-- product slug --}}
            <div class="mb-4">
                <x-label value="Slug" />
                <x-input type="text" disabled placeholder="Slug del producto" class="w-full bg-gray-200"
                    wire:model="slug" />
                <x-input-error for="slug" />
            </div>
            {{-- product description --}}
            <div class="mb-4">
                <div wire:ignore>
                    <x-label value="Descripción" />
                    {{-- <textarea class="w-full form-control" rows="4" wire:model="product.description">
                    </textarea> --}}
                    <textarea class="w-full form-control" rows="4" wire:model="product.description" x-data x-init="ClassicEditor.create($refs.textEditor, {
                        removePlugins: [ 'Heading' ],
                        toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' , 'link' ]
                        } )
                        .then(function(editor) {
                            editor.model.document.on('change:data', () => {
                                @this.set('product.description', editor.getData())
                            })
                        })
                        .catch(error => {
                            console.error(error);
                        });"
                        x-ref="textEditor">
                    </textarea>

                </div>
                <x-input-error for="product.description" />
            </div>
            <div class="grid grid-cols-2 gap-6 mb-4">
                {{-- product brand --}}
                <div>
                    <x-label value="Marca" />
                    <select class="form-control w-full" wire:model="product.brand_id">
                        <option value="" selected disabled>Selecciona una marca</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>

                    <x-input-error for="product.brand_id" />
                </div>
                {{-- product price    --}}
                <div>
                    <x-label value="Precio" />
                    <x-input type="number" step="0.1" placeholder="Precio del producto" class="w-full"
                        wire:model="product.price" />

                    <x-input-error for="product.price" />
                </div>
            </div>
            @if ($this->subcategory)
                @if (!$this->subcategory->color && !$this->subcategory->size && !$this->subcategory->weight)
                    <div class="mb-4">
                        <x-label value="Cantidad" />
                        <x-input type="number" placeholder="Cantidad del producto" class="w-full"
                            wire:model="product.quantity" />
                        <x-input-error for="product.quantity" />
                    </div>
                @endif
            @endif
            <div class="flex justify-end items-center">
                <x-action-message class="mr-3" on="saved">
                    Actualizado
                </x-action-message>
                <x-button class="" wire:loading.attr="disabled" wire:target="save" wire:click="save">
                    Actualizar producto
                </x-button>
            </div>
        </div>

        @if ($this->subcategory)
            @if ($this->subcategory->size)
                @livewire('admin.size-product', ['product' => $product], key('size-product' . $product->id))
            @elseif($this->subcategory->color)
                @livewire('admin.color-product', ['product' => $product], key('color-product' . $product->id))
            @elseif($this->subcategory->weight)
                @livewire('admin.weight-product', ['product' => $product], key('weight-product' . $product->id))
            @endif
        @endif
    </div>

    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzone = {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: 'Arrastra o selecciona una imagen para el producto.',
                acceptedFiles: 'image/*',
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function() {
                    Livewire.emit('refreshProduct');
                }
            };

            Livewire.on('deleteProduct', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonweight: '#3085d6',
                    cancelButtonweight: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.edit-product', 'delete');
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })

            Livewire.on('deleteSize', sizeId => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonweight: '#3085d6',
                    cancelButtonweight: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.size-product', 'delete', sizeId);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })

            Livewire.on('deleteWeight', pivot => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonweight: '#3085d6',
                    cancelButtonweight: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.weight-product', 'delete', pivot);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })

            Livewire.on('deletePivot', pivot => {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.color-product', 'delete', pivot);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })

            Livewire.on('deleteColorSize', pivot => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.color-size', 'delete', pivot);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush
</div>
