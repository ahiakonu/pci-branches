@props(['name', 'lablename', 'input_required' => 'true'])


<x-app-layout-form.label name="{{ $name }}" lablename="{{ $lablename }}" />

<div id="datepicks" class="flex flex-col justify-center md:flex-row md:justify-between">
    <input id="datepick"  type="text" name="{{ $name }}"
        {{ $attributes([
            'class' => 'datepick w-full leading-5 relative text-sm py-2 px-4 rounded text-gray-800 bg-white 
                            border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 
                            dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600',
        ]) }}
        {{ $input_required == 'true' ? 'required' : '' }}>
</div>
<x-app-layout-form.error name="{{ $name }}" />
