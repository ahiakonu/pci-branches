@props(['href'])
<div>
    <a class="py-2 px-4 mb-3 block lg:inline-block text-center rounded leading-5 text-gray-100
         bg-indigo-500 border border-indigo-500 hover:text-white hover:bg-indigo-600 hover:ring-0 
         hover:border-indigo-600 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0"
        href="{{ $href }}">
        {{ $slot }}
        <x-app-svg.plus />

    </a>
</div>
