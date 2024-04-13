<div class="w-full mb-6 overflow-x-auto "> {{-- hidden-header hidden-sort-after --}}
    <table
        {{ $attributes(['class' => 'table-sorter table-bordered w-full ltr:text-left rtl:text-right text-gray-600 dark:text-gray-400 ']) }}>
        {{ $slot }}
    </table>
</div>
