<x-app-layout>
    <div class="flex flex-wrap flex-row my-3">
        <div class="flex-shrink max-w-full px-4 w-full">
            <p class="text-xl font-bold mt-0 mb-5">Zonal Reports</p>
        </div>

        <div class="flex-shrink max-w-full px-4 w-full mb-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-wrap flex-row -mx-4">
                    <div class="flex-shrink max-w-full px-4 w-full">
                        <div class="md:flex md:justify-between">
                            <x-app-layout-form.add-button href="{{ route('zonal.branch.reports') }}">Add Zone Report
                            </x-app-layout-form.add-button>
                        </div>
                        <x-app-layout.flash />

                        <div>
                            <form> {{-- action="{{ route('admin.ajax_GenerateReportAll') }}" --}}

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
                                @if ($reports != null)
                                    @foreach ($reports as $report)
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
                                                  
                                                        <a href="javascript:;"  
                                                            onclick="SumitEdit('View zone report {{ $report->church_name }}  {{ $report->report_month }}, {{ $report->report_year }} report ?','/zonal/zone/{{ $report->id }}/show')"
                                                            class="py-1 px-4 inline-block text-sm text-center mb-3 rounded leading-5
                                                            text-indigo-500 bg-transparent border border-indigo-500 hover:text-gray-100
                                                            hover:bg-indigo-500 hover:ring-0 hover:border-indigo-500 focus:text-gray-100
                                                            focus:bg-indigo-500 focus:border-indigo-500 focus:outline-none focus:ring-0">
                                                            view zone report
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
