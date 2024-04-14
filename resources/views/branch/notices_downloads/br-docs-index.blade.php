<x-app-layout>
    <div class="flex flex-wrap flex-row">
        <div class="flex-shrink max-w-full px-4 w-full">
            <p class="text-xl font-bold mt-0 mb-5">Document Downloads
            </p>
        </div>

        <div class="flex-shrink max-w-full px-4 w-full mb-6 my-3">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-wrap flex-row -mx-4">
                    <div class="flex-shrink max-w-full px-4 w-full">


                        <x-app-layout.flash />

                        <div>
                            {{-- <form>
                                <div id="bulk-actions">
                                    <x-app-layout.generate-button text="View Policies" />
                                    </label>
                                </div>
                            </form> --}}
                        </div>




                        <x-app-layout-table.table class="hidden-header hidden-sort-after">
                            <x-app-layout-table.thead>

                                <x-app-layout-table.th lablename="Title" />
                                <x-app-layout-table.th lablename="File Name" />
                                <x-app-layout-table.th lablename="Status" />
                                <x-app-layout-table.th data-sortable="false" lablename="Actions" />
                            </x-app-layout-table.thead>
                            <x-app-layout-table.tbody>
                                @if ($document != null)
                                    @foreach ($document as $evt)
                                        <tr>
                                            <x-app-layout-table.td> {{ $evt->title }}</x-app-layout-table.td>
                                            <x-app-layout-table.td> {{ $evt->original_name }} </x-app-layout-table.td>



                                            <x-app-layout-table.td>
                                                <div class="flex space-x-1">

                                                    <a href="{{ \Illuminate\Support\Facades\Storage::url($evt->file_path) }}"
                                                        target="_blank"
                                                        class="py-1 px-4 inline-block text-sm text-center mb-3 rounded leading-5
                                                        text-indigo-500 bg-transparent border border-indigo-500 hover:text-gray-100
                                                        hover:bg-indigo-500 hover:ring-0 hover:border-indigo-500 focus:text-gray-100
                                                        focus:bg-indigo-500 focus:border-indigo-500 focus:outline-none focus:ring-0">
                                                        Download</a>
                                                </div>
                                            </x-app-layout-table.td>
                                        </tr>
                                    @endforeach
                                @endif
                            </x-app-layout-table.tbody>
                        </x-app-layout-table.table>
                    </div>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
