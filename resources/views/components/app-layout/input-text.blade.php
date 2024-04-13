@props(['name', 'lablename', 'input_type' => 'text', 'input_required' => 'true'])

<div {{ $attributes(['class' => 'flex-shrink max-w-full px-4 w-full mb-6']) }}>{{-- class=" md:w-1/2 " --}}
    <x-app-layout.input-lable name="{{ $name }}" lablename="{{ $lablename }}" />

    <input type="{{ $input_type }}" value="{{ old($name) }}" wire:model="{{ $name }}"
        class="w-full leading-5 relative py-2 px-4 rounded text-gray-800  bg-white border border-gray-300 overflow-x-auto 
        focus:outline-none focus:border-gray-400 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 
        dark:focus:border-gray-600"
        {{ $input_required=='true' ? 'required' : '' }}>

    <x-app-layout.input-error name="{{ $name }}" />
</div>
