<x-app-layout>
    <div class="flex flex-wrap flex-row my-3">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Zonal Branch Summary Reports</p>

            <x-app-layout.back-button href="{{ route('zonal.zone.index',['year'=> request()->get('year'), 'month' => '']) }}" />
        </div>

        <div class="flex-shrink max-w-full px-4 w-full mb-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-wrap flex-row -mx-4">
                    <div class="flex-shrink max-w-full px-4 w-full">

                        <x-app-layout.flash />

                        <div>
                            <form>  

                                <div id="bulk-actions">
                                    <label class="flex flex-wrap flex-row space-x-1">


                                        <select id="year" name="year" onchange="HideButton('hide')" required
                                            class="inline-block leading-5 relative py-2 ltr:pl-3 rtl:pr-3 pr-8 mb-3 rounded bg-gray-100 border border-gray-200 overflow-x-auto focus:outline-none focus:border-gray-300 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none">
                                            <option value="" data-dialog-content="">Select Year * </option>
                                            @foreach ($years as $year)
                                                @if (request()->get('year') == $year->reportyear)
                                                    <option selected value="{{ $year->reportyear }}">
                                                        {{ $year->reportyear }}
                                                    </option>
                                                @else
                                                    <option value="{{ $year->reportyear }}">{{ $year->reportyear }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>

                                        <select id="month" name="month" onchange="HideButton('hide')"
                                            class="inline-block leading-5 relative py-2 ltr:pl-3 rtl:pr-3 pr-8 mb-3 rounded bg-gray-100 border border-gray-200 overflow-x-auto focus:outline-none focus:border-gray-300 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none">
                                            <option value="" data-dialog-content="">Select Month</option>
                                            @foreach ($months as $month)
                                                @if (request()->get('month') == $month['monthkey'])
                                                    <option selected value="{{ $month['monthkey'] }}">
                                                        {{ $month['month'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $month['monthkey'] }}">{{ $month['month'] }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <button id="bulk_apply" onchange="HideButton('show')"
                                            class="ltr:ml-2 rtl:mr-2 py-2 px-4 inline-block text-center mb-3 rounded leading-5 border hover:bg-gray-300 dark:bg-gray-900 dark:bg-opacity-40 dark:border-gray-800 dark:hover:bg-gray-900 focus:outline-none focus:ring-0 cursor-pointer">Generate
                                            Report</button>

                                    </label>
                                </div>
                            </form>
                        </div>

                        <div>
                            @php

                                if ($reports == null) {
                                    $truefalse = 'none';
                                } else {
                                    if ($reports->count() <= 0) {
                                        $truefalse = 'none';
                                    } else {
                                        $truefalse = 'block';
                                    }
                                }
                            @endphp
                            {{-- <form method="get" id="generateForm"
                                action="{{ route('branchreport.exportBranchReports') }}">
                                <input type="hidden" name="down_month" value="{{ request()->get('month') }}">
                                <input type="hidden" name="down_year" value="{{ request()->get('year') }}">
                                <button type="submit" style="display: {{ $truefalse }}"
                                    class="py-2 px-4 mb-3 block lg:inline-block text-center rounded leading-5 text-gray-100 bg-pink-500 border border-ping-500 hover:text-white hover:bg-pink-600 hover:ring-0 hover:border-pink-600 focus:bg-pink-600 focus:border-pink-600 focus:outline-none focus:ring-0">
                                    Download Report
                                </button>
                            </form> --}}

                        </div>
                        <hr>

                        <x-app-layout-table.table class="hidden-header hidden-sort-after">
                            <x-app-layout-table.thead>
                                <x-app-layout-table.th lablename="" />
                                <x-app-layout-table.th lablename="Church" />
                                <x-app-layout-table.th lablename="Year" />
                                <x-app-layout-table.th lablename="Month" />
                                <x-app-layout-table.th lablename="*Tithe" />
                                <x-app-layout-table.th lablename="*1st_Offering" />
                                <x-app-layout-table.th lablename="Amalgamation" />
                                <x-app-layout-table.th lablename="Cell_Offering" />
                                <x-app-layout-table.th lablename="Total_Income" />
                                <x-app-layout-table.th lablename="Attenance(All)" />
                                <x-app-layout-table.th data-sortable="false" lablename="Actions" />
                            </x-app-layout-table.thead>
                            <x-app-layout-table.tbody>
                                @if ($reports != null)
                                    @foreach ($reports as $report)
                                        <tr>
                                            <x-app-layout-table.td>
                                                <div class="flex">
                                                    <x-app-layout.tooltip-header>
                                                        <a href="javascript:;" x-on:mouseover="tooltips = true"
                                                            x-on:mouseleave="tooltips = false"
                                                            onclick="SumitEdit('Create zone report for {{ $report->church_name }} for  {{ $report->month }},{{ $report->year }} report ?','{{ route('zonal.zone.create', ['year' => $report->year, 'month' => $report->mm,'branch'=>$report->brID]) }}')"
                                                            class="inline-block ltr:mr-2 rtl:ml-2 hover:text-green-500">
                                                            <x-app-svg.openfolder /> 
                                                            <x-app-layout.tooltip-details tooltip_label="report" />
                                                        </a>
                                                    </x-app-layout.tooltip-header>
                                                </div>
                                            </x-app-layout-table.td>
                                            <x-app-layout-table.td> {{ $report->church_name }} </x-app-layout-table.td>
                                            <x-app-layout-table.td> {{ $report->year }} </x-app-layout-table.td>
                                            <x-app-layout-table.td>{{ $report->month }}</x-app-layout-table.td>
                                            <x-app-layout-table.td> @fmoney($report->tithe) </x-app-layout-table.td>

                                            <x-app-layout-table.td> @fmoney($report->first_offering) </x-app-layout-table.td>
                                            <x-app-layout-table.td> @fmoney($report->amalgamation) </x-app-layout-table.td>
                                            <x-app-layout-table.td> @fmoney($report->cell_offering) </x-app-layout-table.td>
                                            <x-app-layout-table.td>
                                                @fmoney($report->total)
                                            </x-app-layout-table.td>
                                            <x-app-layout-table.td>{{ $report->attendance }} </x-app-layout-table.td>



                                            <x-app-layout-table.td>
                                                <div class="flex space-x-1">
                                                    <a href="javascript:;"  
                                                    onclick="SumitEdit('Create zone report for {{ $report->church_name }} for  {{ $report->month }},{{ $report->year }} report ?','{{ route('zonal.zone.create', ['year' => $report->year, 'month' => $report->mm,'branch'=>$report->brID]) }}')"
                                                    class="py-1 px-4 inline-block text-sm text-center mb-3 rounded leading-5
                                                    text-indigo-500 bg-transparent border border-indigo-500 hover:text-gray-100
                                                    hover:bg-indigo-500 hover:ring-0 hover:border-indigo-500 focus:text-gray-100
                                                    focus:bg-indigo-500 focus:border-indigo-500 focus:outline-none focus:ring-0">
                                                    new zone report
                                                </a>

                                                <a href="javascript:;"  
                                                onclick="SumitEdit('View branch report details {{ $report->church_name }} for  {{ $report->month }},{{ $report->year }} report ?','{{ route('zonal.branch.show', ['year' => $report->year, 'month' => $report->mm,'branch'=>$report->brID]) }}')"
                                                class="py-1 px-4 inline-block text-sm text-center mb-3 rounded leading-5
                                                text-green-500 bg-transparent border border-green-500 hover:text-gray-100
                                                hover:bg-green-500 hover:ring-0 hover:border-green-500 focus:text-gray-100
                                                focus:bg-green-500 focus:border-green-500 focus:outline-none focus:ring-0">
                                                branch report details
                                            </a>
                                                     
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

<script>
    function HideButton(hideshow) {
        var x = document.getElementById("generateForm");
        if (hideshow === "hide") {
            x.style.display = "none";
        }
    }
</script>
