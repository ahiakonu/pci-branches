<input
    class="w-full leading-5 relative py-2 px-4 p-10 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600"
    type="file" accept=".pdf" name="pdf_file" value="{{old('pdf_file')}}" >
<x-app-layout-form.error name="pdf_file"></x-app-layout-form.error>
