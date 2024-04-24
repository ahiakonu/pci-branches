@props(['lable', 'link'])
@php
$url = '/' . Route::current()->uri;//->ltrim($link, '/') ? 'text-indigo-500' : '';
$active = str_starts_with($url, $link) ? 'text-indigo-500' : '';
// Log::info($url);
// Log::info($link);
@endphp
<li class="relative">
    <a href="{{ $link }}"
        {{ $attributes([
            'class' =>
                'block w-full py-2 px-6 clear-both whitespace-nowrap 
                            hover:text-indigo-500 dark:hover:text-gray-300 ' . $active,
        ]) }}>

        {{ $lable }}</a>
</li>