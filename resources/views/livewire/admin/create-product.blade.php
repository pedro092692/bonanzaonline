<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl text-center font-semibold mb-8">Complete esta información para crear un producto</h1>
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
            <select class="w-full form-control" wire:model="subcategory_id">
                <option value="" selected disabled>Seleciona una subcategoría</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
            <x-input-error for="subcategory_id" />
        </div>
    </div>
    {{-- product name --}}
    <div class="mx-auto bg-white shadow-lg rounded py-8 px-4">
        <div class="mb-4">
            <x-label value="Nombre" />
            <x-input type="text" placeholder="Ingresa el nombre del producto" class="w-full" wire:model="name" />
            <x-input-error for="name" />
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
                <textarea class="w-full form-control" rows="4" wire:model="description" x-data x-init="ClassicEditor.create($refs.textEditor, {
                    removePlugins: [ 'Heading' ],
                    toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' , 'link' ]
                    })
                    .then(function(editor) {
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData())
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });"
                    x-ref="textEditor">
                </textarea>
            </div>        
            <x-input-error for="description" />
        </div>
        <div class="grid grid-cols-2 gap-6 mb-4">
            {{-- product brand --}}
            <div>
                <x-label value="Marca" />
                <select class="form-control w-full" wire:model="brand_id">
                    <option value="" selected disabled>Selecciona una marca</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                
                <x-input-error for="brand_id" />
            </div>
            {{-- product price    --}}
            <div>
                <x-label value="Precio" />
                <x-input type="number" 
                         step="0.1" 
                         placeholder="Precio del producto" 
                         class="w-full" 
                         wire:model="price"/>
                         
                <x-input-error for="price" />
            </div>
            
        </div>
        @if ($subcategory_id)
            @if (!$this->subcategory->color && !$this->subcategory->size && !$this->subcategory->weight)
                <div class="mb-4">
                    <x-label value="Cantidad" />
                    <x-input type="number" 
                             placeholder="Cantidad del producto" 
                             class="w-full" 
                             wire:model="quantity"/>
                    <x-input-error for="quantity" />
                </div>
            @endif
        @endif
        <div class="flex">
            <x-button class="ml-auto"
                wire:loading.attr="disabled"
                wire:target="save"
                wire:click="save"
                >
                Crear producto
            </x-button>
        </div>
    </div>
</div>
