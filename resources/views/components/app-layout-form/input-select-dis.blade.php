@props(['name', 'lablename', 'show_lable' => 'true'])

<div {{ $attributes(['class' => 'flex-shrink max-w-full px-4 w-full mb-6']) }}>{{-- class=" md:w-1/2 " --}}

    @if ($show_lable === 'true')
        <x-app-layout-form.label name="{{ $name }}" lablename="{{ $lablename }}" />
    @endif

    <select name="{{ $name }}" id="{{ $name }}" disabled
        class="inline-block w-full leading-5 relative py-2 pl-3 pr-8 rounded text-gray-800 border
            border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 dark:text-gray-300
            dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none  bg-gray-50"
        required>

        <option value="" selected>Select {{ $lablename }}</option>
        {{ $slot }}
    </select>
    <x-app-layout-form.error name="{{ $name }}" />
</div>
