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

            <div class="flex-shrink max-w-full px-4 w-full lg:w-1/4">
                <div class="bg-gray-500 text-blue-100 rounded-lg shadow-lg p-6 mb-6 relative overflow-hidden">
                    <!-- circle -->
                    <div class="absolute ltr:-right-10 rtl:-left-10 -top-10">
                        <div class="bg-white opacity-10 w-36 h-36 rounded-full"></div>
                    </div>
                    <div class="absolute ltr:-right-8 rtl:-left-8 -top-8">
                        <div class="bg-white opacity-20 w-24 h-24 rounded-full"></div>
                    </div>

                    <div class="flex flex-row justify-between pb-3">
                        <div class="flex flex-col">
                            <h3 class="text-base font-bold text-white">Branch Reports In {{ $thisyear }} </h3>
                        </div>
                    </div>
                    <div class="relative text-center">
                        <h4 class="font-bold text-2xl text-white mb-3"> {{ $dash['reports_count'] }} </h4>
                        <a class="text-sm mb-3 hover:text-blue-500 text-white" href="/admin/reports/branchreports">View
                            more..
                            </span></a>
                    </div>
                </div>
            </div>

            <div class="flex-shrink max-w-full px-4 w-full lg:w-1/4">


                <div class="bg-pink-500 text-pink-100 rounded-lg shadow-lg p-6 mb-6 relative overflow-hidden">
                    <!-- circle -->
                    <div class="absolute ltr:-right-10 rtl:-left-10 -top-10">
                        <div class="bg-white opacity-10 w-36 h-36 rounded-full"></div>
                    </div>
                    <div class="absolute ltr:-right-8 rtl:-left-8 -top-8">
                        <div class="bg-white opacity-20 w-24 h-24 rounded-full"></div>
                    </div>

                    <div class="flex flex-row justify-between pb-3">
                        <div class="flex flex-col">
                            <h3 class="text-base font-bold">Zonal Reports In {{ $thisyear }} </h3>
                        </div>
                    </div>
                    <div class="relative text-center">
                        <h3 class="font-bold text-2xl text-white mb-3"> figure here </h3>
                        <a class="text-sm mb-3 hover:text-indigo-500 "
                            href="{{ route('admin.report.branchReports') }}">View more.. </a>
                    </div>
                </div>
            </div>


            <div class="flex-shrink max-w-full px-4 w-full lg:w-1/4">
                <div class="bg-indigo-500 text-indigo-100 rounded-lg shadow-lg p-6 mb-6 relative overflow-hidden">
                    <!-- circle -->
                    <div class="absolute ltr:-right-10 rtl:-left-10 -top-10">
                        <div class="bg-white opacity-10 w-36 h-36 rounded-full"></div>
                    </div>
                    <div class="absolute ltr:-right-8 rtl:-left-8 -top-8">
                        <div class="bg-white opacity-20 w-24 h-24 rounded-full"></div>
                    </div>

                    <div class="flex flex-row justify-between pb-3">
                        <div class="flex flex-col">
                            <h3 class="text-base font-bold">Divisional Reports In {{ $thisyear }} </h3>
                        </div>
                    </div>
                    <div class="relative text-center">
                        <h4 class="font-bold text-2xl text-white mb-3">figure here</h4>
                        <p class="text-sm mb-3">This week lost <span class="font-semibold">(2 Deal)</span></p>
                    </div>
                </div>
            </div>

            <div class="flex-shrink max-w-full px-4 w-full lg:w-1/4">
                <div class="bg-yellow-500 text-yellow-100 rounded-lg shadow-lg p-6 mb-6 relative overflow-hidden">
                    <!-- circle -->
                    <div class="absolute ltr:-right-10 rtl:-left-10 -top-10">
                        <div class="bg-white opacity-10 w-36 h-36 rounded-full"></div>
                    </div>
                    <div class="absolute ltr:-right-8 rtl:-left-8 -top-8">
                        <div class="bg-white opacity-20 w-24 h-24 rounded-full"></div>
                    </div>

                    <div class="flex flex-row justify-between pb-3">
                        <div class="flex flex-col">
                            <h3 class="text-base font-bold text-white">Active Churches</h3>
                        </div>
                    </div>
                    <div class="relative text-center">
                        <h4 class="font-bold text-2xl text-white mb-3"> {{ $dash['active_churches'] }} </h4>
                        <a class="text-sm mb-3 hover:text-indigo-500 text-white"
                            href="{{ route('admin.report.branchesReport') }}">View more..
                        </a>
                    </div>
                </div>
            </div>
        </div>


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
