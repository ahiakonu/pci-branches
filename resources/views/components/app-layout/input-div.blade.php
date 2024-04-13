@props(['margin' => 'mb-6 '])
<div {{ $attributes(['class' => 'flex-shrink max-w-full px-4 w-full ' . $margin]) }}>
    {{ $slot }}
</div>
