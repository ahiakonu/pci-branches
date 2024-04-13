@props(['lable', 'link'])
@php
    $url = '/' . Route::current()->uri; 
    $active = str_contains($url, $link) ? 'text-indigo-500' : '';
@endphp
<li class="relative">
    <a href="{{ $link }}"
        {{ $attributes(['class' => 'block py-2.5 px-6 hover:text-indigo-500 dark:hover:text-gray-300 ' . $active]) }}>

        {{ $slot }}
                {{ $lable }}

    </a>
</li>
