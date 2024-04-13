<div>
    <button @click="form_open = true" 
        class="py-2 px-4 mb-3 block lg:inline-block text-center rounded leading-5 text-gray-100 bg-indigo-500 border border-indigo-500 hover:text-white hover:bg-indigo-600 hover:ring-0 hover:border-indigo-600 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0">
        {{$slot}}
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
            fill="currentColor" class="inline-block ltr:ml-1 rtl:mr-1 bi bi-plus-lg"
            viewBox="0 0 16 16">
            <path
                d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z">
            </path>
        </svg>
    </button>
</div>