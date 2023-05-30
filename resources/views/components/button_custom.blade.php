@props(['color' => 'green'])
<button {{ $attributes->merge(['type' => 'submit', 'class' => "flex justify-center items-center px-4 py-2 bg-$color-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-$color-600 focus:bg-$color-500 active:bg-$color-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"]) }}>
    {{ $slot }}
</button>
