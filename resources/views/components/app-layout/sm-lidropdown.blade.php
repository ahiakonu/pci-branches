@props(['sel_index', 'lable', 'sgv'])
<li class="relative">
    <a :class="{ 'text-indigo-500 dark:text-gray-300': selected == {{ $sel_index }} }"
        @click="selected !== {{ $sel_index }} ? selected = {{ $sel_index }}  : selected = null"
        class="block py-2.5 px-6 hover:text-indigo-500 dark:hover:text-gray-300" href="javascript:;">
        @if ($sgv == 'Utilities')
            <x-app-svg.settings />
        @elseif ($sgv == 'Dashboard')
        <x-app-svg.dashboard />
        @endif

        <!-- <i class="ltr:mr-2 rtl:ml-2 fas fa-home"></i> -->
        <span>{{ $lable }}</span>
        <!-- caret -->
        <x-app-svg.caret sel_index="{{ $sel_index }}" />
    </a>

    <!-- dropdown menu -->
    <ul x-show="selected == {{ $sel_index }} " x-transition:enter="transition-all duration-200 ease-out"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        class="block rounded rounded-t-none top-full z-50 ltr:pl-7 rtl:pr-7 py-0.5 ltr:text-left rtl:text-right mb-1 font-normal">

        {{ $slot }}
    </ul>
</li>



 