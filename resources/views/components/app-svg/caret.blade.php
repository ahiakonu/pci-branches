@props(['sel_index'])
<span class="inline-block ltr:float-right rtl:float-left">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
        class="transform transition duration-300 mt-1.5 bi bi-chevron-down"
        :class="{
            'rotate-0': selected == {{$sel_index}},
            'ltr:-rotate-90 rtl:rotate-90': !(selected == {{$sel_index}})
            }"
        width=".8rem" height=".8rem" viewBox="0 0 16 16">
        <path fill-rule="evenodd"
            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    </svg>
    <!-- <i class="transform transition duration-300 fas fa-chevron-down" :class="{ 'rotate-0': selected == {{ $sel_index }}, 'ltr:-rotate-90 rtl:rotate-90': !(selected == {{ $sel_index }}) }"></i> -->
</span>

