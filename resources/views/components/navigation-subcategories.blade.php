@props(['category'])
<div class="grid grid-cols-4 p-4">
    <div>
        <p class="text-xl font-bold text-center text-gray-500 mb-3">Subcategorías
        </p>
        <ul>
            @if (isset($category->subcategories))
                @foreach ($category->subcategories as $subcategory)
                    <li>
                        <a href="{{route('categories.show', $category) .'?subcategory_select='. $subcategory->slug}}"
                            class="text-gray-500 font-semibold inline-block py-1 px-4 hover:text-green-600">
                            {{ $subcategory->name }}
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

    @if (isset($category->image))
        <div class="col-span-3">
            <img class="h-64 w-full object-cover object-center"
                src="{{ Storage::url($category->image) }}" alt="">
        </div>
    @endif
</div>