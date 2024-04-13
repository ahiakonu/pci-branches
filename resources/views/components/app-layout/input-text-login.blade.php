@props(['name', 'input_type', 'placeholder'])

<div class="mb-6">
    <input name="{{ $name }}"
        class="w-full leading-5 relative py-2 px-4 rounded text-gray-800 
        bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 
        focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600"
        placeholder="{{ $placeholder }}" 
        value="{{ old($name) }}" 
        aria-label="{{ $name }}"
        type="{{ $input_type }}" 
        required="">
    <x-app-layout.input-error name="{{ $name }}" />
</div>
