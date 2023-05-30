<x-app-layout>
    <div class="container py-8">
        <figure>
            <img src="{{Storage::url($category->image)}}" alt="" class="w-full h-80 object-cover object-center mb-4">
        </figure>

        @livewire('category-filter', ['category' => $category])
    </div>
</x-app-layout>