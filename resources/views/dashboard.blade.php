<x-app-layout>
    <div class="px-4">
        @php
            $thisyear = now()->year;
        @endphp

        {{-- row 1 --}}
        <div class="flex flex-wrap flex-row">
            <div class="flex-shrink max-w-full px-4 w-full">
                <p class="text-xl font-bold mt-3 mb-5">Admin Dashboard</p>
            </div>



            {{-- Branch Reports --}}
            <div class="flex-shrink max-w-full px-4 w-full sm:w-1/4 lg:w-1/4 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6 relative overflow-hidden">
                    <h3 class="text-base font-bold mb-2">Branch Reports In {{ $thisyear }}</h3>

                    <div class="relative text-center">
                        <h2 class="text-3xl font-bold mb-4">{{ $dash['reports_count'] }} </h2>
                    </div>

                    <div class="flex flex-row justify-between w-full">
                        <div class="flex items-center text-black-500">
                            <a class="text-sm mb-3 hover:text-gray-500 hover:underline"
                                href="/admin/reports/branchreports">View
                                more..
                                </span></a>
                        </div>
                    </div>

                    <!-- bg circle -->
                    <div class="absolute ltr:-right-16 rtl:-left-16 -top-16">
                        <div class="bg-gray-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-gray-500/10"></div>
                    </div>
                    <div class="absolute ltr:-right-4 rtl:-left-4 -top-24">
                        <div class="bg-gray-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-gray-500/10"></div>
                    </div>
                </div>
            </div>


            {{-- Zonal Reports --}}
            <div class="flex-shrink max-w-full px-4 w-full sm:w-1/4 lg:w-1/4 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6 relative overflow-hidden">
                    <h3 class="text-base font-bold mb-2">Zonal Reports In {{ $thisyear }}</h3>

                    <div class="relative text-center">
                        <h2 class="text-3xl font-bold mb-4">{{ $dash['zone_reports_count'] }}</h2>
                    </div>

                    <div class="flex flex-row justify-between w-full">
                        <div class="flex items-center text-black-500">
                            <a class="text-sm mb-3 hover:text-red-500 hover:underline"
                                href="{{ route('admin.report.zoneReports') }}">View
                                more..
                                </span></a>
                        </div>
                    </div>

                    <!-- bg circle -->
                    <div class="absolute ltr:-right-16 rtl:-left-16 -top-16">
                        <div class="bg-red-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-red-500/10"></div>
                    </div>
                    <div class="absolute ltr:-right-4 rtl:-left-4 -top-24">
                        <div class="bg-red-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-red-500/10"></div>
                    </div>
                </div>
            </div>


            {{-- Divisional Reports --}}
            <div class="flex-shrink max-w-full px-4 w-full sm:w-1/4 lg:w-1/4 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6 relative overflow-hidden">
                    <h3 class="text-base font-bold mb-2">Divisional Reports In {{ $thisyear }}</h3>

                    <div class="relative text-center">
                        <h2 class="text-3xl font-bold mb-4">{{ $dash['division_reports_count'] }}</h2>
                    </div>

                    <div class="flex flex-row justify-between w-full">
                        <div class="flex items-center text-black-500">
                            <a class="text-sm mb-3 hover:text-red-500 hover:underline"
                                href=" ">View
                                more..
                                </span></a>
                        </div>
                    </div>

                    <!-- bg circle -->
                    <div class="absolute ltr:-right-16 rtl:-left-16 -top-16">
                        <div class="bg-indigo-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-red-500/10"></div>
                    </div>
                    <div class="absolute ltr:-right-4 rtl:-left-4 -top-24">
                        <div class="bg-indigo-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-red-500/10"></div>
                    </div>
                </div>
            </div>




            {{-- Churches Reports --}}
            <div class="flex-shrink max-w-full px-4 w-full sm:w-1/4 lg:w-1/4 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6 relative overflow-hidden">
                    <h3 class="text-base font-bold mb-2">Active Churches</h3>

                    <div class="relative text-center">
                        <h2 class="text-3xl font-bold mb-4">{{ $dash['active_churches'] }} </h2>
                    </div>

                    <div class="flex flex-row justify-between w-full">
                        <div class="flex items-center text-black-500">
                            <a class="text-sm mb-3 hover:text-yellow-500 hover:underline"
                                href="{{ route('admin.report.branchesReport') }}">View
                                more..
                                </span></a>
                        </div>
                    </div>

                    <!-- bg circle -->
                    <div class="absolute ltr:-right-16 rtl:-left-16 -top-16">
                        <div class="bg-yellow-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-yellow-500/10">
                        </div>
                    </div>
                    <div class="absolute ltr:-right-4 rtl:-left-4 -top-24">
                        <div class="bg-yellow-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-yellow-500/10">
                        </div>
                    </div>
                </div>
            </div>

<br>
            {{-- rows - list  --}}
            <div class="p-6   bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">

                <div class="md:flex md:justify-between">
                    <h2 class="text-lg">
                        Recently Submitted Reports</h2>
                </div>

                <hr class="mb-4 ">

                <x-app-layout.flash />

                <x-app-layout-table.table class="hidden-header hidden-sort-after">
                    <x-app-layout-table.thead>
                        <x-app-layout-table.th lablename="Division" />
                        <x-app-layout-table.th lablename="Branch" />
                        <x-app-layout-table.th lablename="Date" />
                        <x-app-layout-table.th lablename="Attendance" />
                        <x-app-layout-table.th lablename="Curr" />
                        <x-app-layout-table.th lablename="Tot. Income" />
                        <x-app-layout-table.th lablename="Amalgamtion" />
                        <x-app-layout-table.th lablename="Service" />
                        <x-app-layout-table.th lablename="Theme" />
                        <x-app-layout-table.th lablename="Preacher" />
                        <x-app-layout-table.th data-sortable="false" lablename="Actions" />
                    </x-app-layout-table.thead>
                    <x-app-layout-table.tbody>
                        @foreach ($reports_top as $tt)
                            <tr>
                                <x-app-layout-table.td> {{ $tt->division_name }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $tt->church_name }} </x-app-layout-table.td>
                                <x-app-layout-table.td>
                                    {{ $tt->service_date }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $tt->attendance }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $tt->currency }} </x-app-layout-table.td>
                                <x-app-layout-table.td> @fmoney($tt->total_income)</x-app-layout-table.td>
                                <x-app-layout-table.td> @fmoney($tt->amalgamation)</x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $tt->service }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $tt->theme_and_sermon }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $tt->name_of_preacher }} </x-app-layout-table.td>
                                <x-app-layout-table.td>
                                    <div class="flex">

                                        <x-app-layout.tooltip-header>
                                            <a x-on:mouseover="tooltips = true" x-on:mouseleave="tooltips = false"
                                                href="{{ route('admin.branchreport.show', $tt->id) }}"
                                                class="inline-block ltr:mr-2 rtl:ml-2 hover:text-green-500">
                                                <x-app-svg.openfolder />
                                                <x-app-layout.tooltip-details tooltip_label="view" />
                                            </a>
                                        </x-app-layout.tooltip-header>

                                        <x-app-layout.tooltip-header>
                                            <a x-on:mouseover="tooltips = true" x-on:mouseleave="tooltips = false"
                                                href="{{ route('admin.branchreport.edit', $tt->id) }}"
                                                class="inline-block ltr:mr-2 rtl:ml-2 hover:text-green-500">
                                                <x-app-svg.edit />
                                                <x-app-layout.tooltip-details tooltip_label="edit" />
                                            </a>
                                        </x-app-layout.tooltip-header>

                                    </div>
                                </x-app-layout-table.td>
                            </tr>
                        @endforeach

                    </x-app-layout-table.tbody>
                </x-app-layout-table.table>

            </div>
        </div>
</x-app-layout>
