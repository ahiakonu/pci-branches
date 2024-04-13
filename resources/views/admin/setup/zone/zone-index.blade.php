<x-app-layout>
    <div class="flex flex-wrap flex-row">
        <div class="flex-shrink max-w-full px-4 w-full">
            <p class="text-xl font-bold mt-0 mb-5">Zones</p>
        </div>

        <div class="flex-shrink max-w-full px-4 w-full mb-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-wrap flex-row -mx-4">
                    <div class="flex-shrink max-w-full px-4 w-full">
                        <div class="md:flex md:justify-between">
                            <x-app-layout-form.add-button href="{{route('zones.create')}}">Add Division Zone
                            </x-app-layout-form.add-button>

                            {{-- <div>
                                <div id="bulk-actions">
                                    <label class="flex flex-wrap flex-row">
                                        <select id="bulk_actions" name="bulk_actions"
                                            class="inline-block leading-5 relative py-2 ltr:pl-3 ltr:pr-8 rtl:pr-3 rtl:pl-8 mb-3 rounded bg-gray-100 border border-gray-200 overflow-x-auto focus:outline-none focus:border-gray-300 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none">
                                            <option>Regions</option>
                                            @foreach ($region_ToCombo as $item)
                                                <option value="{{ $item->id }}"> {{ $item->region_name }} </option>
                                            @endforeach
                                        </select>
                                        <input type="submit" id="bulk_apply"
                                            class="ltr:ml-2 rtl:mr-2 py-2 px-4 inline-block text-center mb-3 rounded leading-5 border hover:bg-gray-300 dark:bg-gray-900 dark:bg-opacity-40 dark:border-gray-800 dark:hover:bg-gray-900 focus:outline-none focus:ring-0 cursor-pointer"
                                            value="Apply">
                                    </label>
                                </div>
                            </div> --}}

                        </div>
                        <x-app-layout.flash />

                        <x-app-layout-table.table class="hidden-header hidden-sort-after">
                            <x-app-layout-table.thead>
                                <x-app-layout-table.th lablename="Zone Name" />
                                <x-app-layout-table.th lablename="Division" class="hidden lg:table-cell" />{{-- <th class="hidden lg:table-cell" data-sortable="" style="width: 10.9187%;"><a href="#" class="dataTable-sorter">Update</a></th> --}}
                                <x-app-layout-table.th lablename="Zonal Leader" />
                                <x-app-layout-table.th data-sortable="false" lablename="Actions" />
                            </x-app-layout-table.thead>
                            <x-app-layout-table.tbody>
                                @foreach ($zones as $zone)
                                    <tr>
                                        <x-app-layout-table.td> {{ $zone->zone_name }} </x-app-layout-table.td>
                                        <x-app-layout-table.td>{{ $zone->division->division_name }}</x-app-layout-table.td>
                                        <x-app-layout-table.td class="hidden lg:table-cell"> {{ $zone->zonal_leader }} </x-app-layout-table.td>

                                        <x-app-layout-table.td>
                                            <div class="flex">
                                                @if ($zone->id != 1)
                                                    <form action="{{ route('zones.destroy', $zone->id) }}"
                                                        method="post"
                                                        onsubmit="return SubmitDelete(this,'Delete {{ $zone->zone_name }}');">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="inline-block ltr:mr-2 rtl:ml-2 hover:text-red-500">
                                                            <x-app-svg.delete />
                                                        </button>
                                                    </form>
                                                    <a href="javascript:;"
                                                        onclick="SumitEdit('Edit {{ $zone->zone_name }} ?','/util/zones/{{ $zone->id }}/edit')"
                                                        class="inline-block ltr:mr-2 rtl:ml-2 hover:text-green-500"
                                                        title="Edit">
                                                        <x-app-svg.edit />
                                                    </a>
                                                @endif
                                            </div>
                                        </x-app-layout-table.td>
                                    </tr>
                                @endforeach

                            </x-app-layout-table.tbody>
                        </x-app-layout-table.table>


                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script></script>
