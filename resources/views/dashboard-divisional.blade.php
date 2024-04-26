<x-app-layout>
    <div class="flex flex-wrap flex-row">
        <div class="flex-shrink max-w-full px-4 w-full">
            <p class="text-xl font-bold mt-0 mb-5">Divisional Overseer
            </p>
        </div>

        {{-- Zones --}}
        <div class="flex-shrink max-w-full px-4 w-full sm:w-1/4 lg:w-1/4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6 relative overflow-hidden">
                <h3 class="text-base font-bold mb-2">Zones In Division</h3>

                <div class="relative text-center">
                    <h2 class="text-3xl font-bold mb-4">{{ $zone_count }} </h2>
                </div>

                <div class="flex flex-row justify-between w-full">
                    <div class="flex items-center text-black-500">
                        {{-- <a class="text-sm mb-3 hover:text-gray-500 hover:underline" href="">View
                            more..
                            </span></a> --}}
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


        {{-- zonal report details --}}
        <div class="flex-shrink max-w-full px-4 w-full sm:w-1/4 lg:w-1/4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6 relative overflow-hidden">
                <h3 class="text-base font-bold mb-2">Zonal Reports {{ now()->year }}</h3>

                <div class="relative text-center">
                    <h2 class="text-3xl font-bold mb-4">{{ $zonal_report_count }} </h2>
                </div>

                <div class="flex flex-row justify-between w-full">
                    <div class="flex items-center text-black-500">
                        <a class="text-sm mb-3 hover:text-gray-500 hover:underline"
                            href="{{ route('divisional.zone.reports') }}">View
                            more..
                            </span></a>
                    </div>
                </div>

                <!-- bg circle -->
                <div class="absolute ltr:-right-16 rtl:-left-16 -top-16">
                    <div class="bg-yellow-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-red-500/10"></div>
                </div>
                <div class="absolute ltr:-right-4 rtl:-left-4 -top-24">
                    <div class="bg-yellow-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-red-500/10"></div>
                </div>
            </div>
        </div>

        {{-- Branchs --}}
        <div class="flex-shrink max-w-full px-4 w-full sm:w-1/4 lg:w-1/4 mb-6">
            <div class="bg-red-100 dark:bg-gray-800 rounded-lg shadow-lg h-full p-6 relative overflow-hidden">
                <h3 class="text-base font-bold mb-2">Active Branches In Division</h3>

                <div class="relative text-center">
                    <h2 class="text-3xl font-bold mb-4">{{ $branch_count }} </h2>
                </div>

                <div class="flex flex-row justify-between w-full">
                    <div class="flex items-center text-black-500">
                        <a class="text-sm mb-3 hover:text-gray-500 hover:underline" href="{{route('divisional.branches')}}">View
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


        {{-- Branch report details --}}
        <div class="flex-shrink max-w-full px-4 w-full sm:w-1/4 lg:w-1/4 mb-6">
            <div class="bg-green-50 dark:bg-gray-800 rounded-lg shadow-lg h-full p-6 relative overflow-hidden">
                <h3 class="text-base font-bold mb-2">Branch Reports {{ now()->year }}</h3>

                <div class="relative text-center">
                    <h2 class="text-3xl font-bold mb-4">{{ $branch_reports_count }} </h2>
                </div>

                <div class="flex flex-row justify-between w-full">
                    <div class="flex items-center text-black-500">
                        <a class="text-sm mb-3 hover:text-gray-500 hover:underline"
                            href="{{ route('divisional.branch.reports') }}">View
                            more..
                            </span></a>
                    </div>
                </div>

                <!-- bg circle -->
                <div class="absolute ltr:-right-16 rtl:-left-16 -top-16">
                    <div class="bg-green-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-red-500/10"></div>
                </div>
                <div class="absolute ltr:-right-4 rtl:-left-4 -top-24">
                    <div class="bg-green-500 opacity-20 w-36 h-36 rounded-full shadow-lg shadow-red-500/10"></div>
                </div>
            </div>
        </div>



        <div class="flex-shrink max-w-full px-4 w-full mb-6 my-3">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-wrap flex-row -mx-4">

                    <div class="flex-shrink max-w-full px-4 w-full">
                        Division Zones

                        <hr>

                        <x-app-layout.flash />


                        <x-app-layout-table.table class="hidden-header hidden-sort-after">
                            <x-app-layout-table.thead>

                                <x-app-layout-table.th lablename="Zone_Name" />
                                <x-app-layout-table.th lablename="Attd_Target" />
                                <x-app-layout-table.th lablename="Income_Target" />
                                <x-app-layout-table.th lablename="Zonal_Overseer" />
                                <x-app-layout-table.th lablename="#Reports" />
                                <x-app-layout-table.th data-sortable="false" lablename="Actions" />
                            </x-app-layout-table.thead>
                            <x-app-layout-table.tbody>
                                @if ($zones != null)
                                    @foreach ($zones as $evt)
                                        <tr>
                                            <x-app-layout-table.td> {{ $evt->zone_name }}</x-app-layout-table.td>
                                            <x-app-layout-table.td> {{ $evt->attendaceTarget }} </x-app-layout-table.td>
                                            <x-app-layout-table.td> @fmoney($evt->incomeTarget) </x-app-layout-table.td>
                                            <x-app-layout-table.td> {{ $evt->zonal_leader }} </x-app-layout-table.td>
                                            <x-app-layout-table.td> {{ $evt->reports }} </x-app-layout-table.td>
                                            <x-app-layout-table.td>
                                                <div class="flex space-x-1">

                                                    <a href="javascript:;"
                                                        onclick="SumitEdit('View {{ ucwords($evt->zone_name) }} records ?','/divisional/zone/reports?zone={{ $evt->id }}&year={{ now()->year }}')"
                                                        class="py-1 px-4 inline-block text-sm text-center mb-3 rounded leading-5
                                                            text-indigo-500 bg-transparent border border-indigo-500 hover:text-gray-100
                                                            hover:bg-indigo-500 hover:ring-0 hover:border-indigo-500 focus:text-gray-100
                                                            focus:bg-indigo-500 focus:border-indigo-500 focus:outline-none focus:ring-0">
                                                        View Reports
                                                    </a>

                                                </div>
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

    <div class="flex-shrink max-w-full px-4 w-full mb-6 my-3">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
            <div class="flex flex-wrap flex-row -mx-4">

                <div class="flex-shrink max-w-full px-4 w-full">
                    Zone Reports {{ now()->year }}
                    <hr>

                    <x-app-layout.flash />





                    <x-app-layout-table.table class="hidden-header hidden-sort-after">
                        <x-app-layout-table.thead>

                            <x-app-layout-table.th lablename="Report_Date" />
                            <x-app-layout-table.th lablename="Rep_Month" />
                            <x-app-layout-table.th lablename="Branch" />
                            <x-app-layout-table.th lablename="Branch_Visited" />
                            <x-app-layout-table.th lablename="Tot_Tithe" />
                            <x-app-layout-table.th lablename="Tot_1stOff" />
                            <x-app-layout-table.th lablename="Amalg_Paid" />
                            <x-app-layout-table.th lablename="Amalg_Correct" />
                            <x-app-layout-table.th lablename="Rec_Verified" />
                            <x-app-layout-table.th data-sortable="false" lablename="Actions" />
                        </x-app-layout-table.thead>
                        <x-app-layout-table.tbody>
                            @if ($zonereports != null)
                                @foreach ($zonereports as $report)
                                    <tr>

                                        <x-app-layout-table.td> {{ $report->created_at }} </x-app-layout-table.td>
                                        <x-app-layout-table.td> {{ $report->report_year }} ,
                                            {{ $report->report_month }} </x-app-layout-table.td>
                                        <x-app-layout-table.td>{{ $report->church_name }} </x-app-layout-table.td>

                                        <x-app-layout-table.td>{{ $report->branch_visited }}
                                        </x-app-layout-table.td>

                                        <x-app-layout-table.td> @fmoney($report->total_tithe) </x-app-layout-table.td>

                                        <x-app-layout-table.td> @fmoney($report->total_first_offering) </x-app-layout-table.td>
                                        <x-app-layout-table.td> @fmoney($report->amalgamation_paid) </x-app-layout-table.td>
                                        <x-app-layout-table.td> {{ $report->algamation_correct }}
                                        </x-app-layout-table.td>

                                        <x-app-layout-table.td>{{ $report->records_verified }}
                                        </x-app-layout-table.td>

                                        <x-app-layout-table.td>
                                            <div class="flex">
                                                <x-app-layout.tooltip-header>
                                                    <a href="javascript:;" x-on:mouseover="tooltips = true"
                                                        x-on:mouseleave="tooltips = false"
                                                        onclick="SumitEdit('View my {{ $report->service_date }}  {{ $report->service }} report ?','/branch/branchreport/{{ $report->id }}')"
                                                        class="inline-block ltr:mr-2 rtl:ml-2 hover:text-green-500">
                                                        <x-app-svg.openfolder />
                                                        <x-app-layout.tooltip-details tooltip_label="details" />
                                                    </a>
                                                </x-app-layout.tooltip-header>
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
