<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full my-3">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Attendance Reports</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">



            <x-app-layout.flash />
            {{-- Report --}}
            <div class="md:flex md:justify-between">


                <div>
                    <form>

                        <div id="bulk-actions">
                            <label class="flex flex-wrap flex-row space-x-1">
                                <select id="div_zone" name="div_zone" onchange="HideButton('hide')" required
                                    class="inline-block leading-5 relative py-2 ltr:pl-3 rtl:pr-3 pr-8 mb-3 rounded bg-gray-100 border border-gray-200 overflow-x-auto focus:outline-none focus:border-gray-300 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none">
                                    <option value="" data-dialog-content="">Select Report Option * </option>
                                    @foreach ($select_divzone as $divzone)
                                        @if (request()->get('div_zone') == $divzone)
                                            <option selected value="{{ $divzone }}">{{ $divzone }}
                                            </option>
                                        @else
                                            <option value="{{ $divzone }}">{{ $divzone }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                <select id="year" name="year" onchange="HideButton('hide')" required
                                    class="inline-block leading-5 relative py-2 ltr:pl-3 rtl:pr-3 pr-8 mb-3 rounded bg-gray-100 border border-gray-200 overflow-x-auto focus:outline-none focus:border-gray-300 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none">
                                    <option value="" data-dialog-content="">Select Year * </option>
                                    @foreach ($years as $year)
                                        @if (request()->get('year') == $year->reportyear)
                                            <option selected value="{{ $year->reportyear }}">{{ $year->reportyear }}
                                            </option>
                                        @else
                                            <option value="{{ $year->reportyear }}">{{ $year->reportyear }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                <select id="month" name="month" onchange="HideButton('hide')"
                                    class="inline-block leading-5 relative py-2 ltr:pl-3 rtl:pr-3 pr-8 mb-3 rounded bg-gray-100 border border-gray-200 overflow-x-auto focus:outline-none focus:border-gray-300 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none">
                                    <option value="" data-dialog-content="">Select Month</option>
                                    @foreach ($months as $month)
                                        @if (request()->get('month') == $month['monthkey'])
                                            <option selected value="{{ $month['monthkey'] }}">{{ $month['month'] }}
                                            </option>
                                        @else
                                            <option value="{{ $month['monthkey'] }}">{{ $month['month'] }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                <select id="division_id" name="division_id" onchange="HideButton('hide')"
                                    class="inline-block leading-5 relative py-2 ltr:pl-3 rtl:pr-3 pr-8 mb-3 rounded bg-gray-100 border border-gray-200 overflow-x-auto focus:outline-none focus:border-gray-300 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none">
                                    <option value="" data-dialog-content="">Select Division </option>
                                    @foreach ($divisions as $division)
                                        @if (request()->get('division_id') == $division->id)
                                            <option selected value="{{ $division->id }}">
                                                {{ $division->division_name }}
                                            </option>
                                        @else
                                            <option value="{{ $division->id }}">{{ $division->division_name }}
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
                        if ($reportdata == null) {
                            $truefalse = 'none';
                        } else {
                            if ($reportdata->count() <= 0) {
                                $truefalse = 'none';
                            } else {
                                $truefalse = 'block';
                            }
                        }
                    @endphp
                    <form method="get" id="generateForm"
                        action="/admin/reports/ajax/attendance?div_zone={{ request()->get('div_zone') }}&div{{ request()->get('division_id') }}=&year={{ request()->get('year') }}&month={{ request()->get('month') }}">
                        <input type="hidden" name="down_division" value="{{ request()->get('division_id') }}">
                        <input type="hidden" name="down_divzone" value="{{ request()->get('div_zone') }}">
                        <input type="hidden" name="down_month" value="{{ request()->get('month') }}">
                        <input type="hidden" name="down_year" value="{{ request()->get('year') }}">
                        <button type="submit" style="display: {{ $truefalse }}"
                            class="py-2 px-4 mb-3 block lg:inline-block text-center rounded leading-5 text-gray-100 bg-pink-500 border border-ping-500 hover:text-white hover:bg-pink-600 hover:ring-0 hover:border-pink-600 focus:bg-pink-600 focus:border-pink-600 focus:outline-none focus:ring-0">
                            Download Report
                        </button>
                    </form>

                </div>
            </div>
            <hr class="mb-4 ">

            <x-app-layout.flash />


            <x-app-layout-table.table class="hidden-header hidden-sort-after">
                <x-app-layout-table.thead>
                    <x-app-layout-table.th lablename="Service_Date" />
                    <x-app-layout-table.th lablename="Division" />
                    @if (request()->get('div_zone') == 'Zone')
                        <x-app-layout-table.th lablename="Zone" />
                    @elseif (request()->get('div_zone') == 'Branch')
                        <x-app-layout-table.th lablename="Branch" />
                    @endif
                    <x-app-layout-table.th lablename="Female" />
                    <x-app-layout-table.th lablename="Male" />
                    <x-app-layout-table.th lablename="Children" />
                    <x-app-layout-table.th lablename="Cell_Attendance" />
                    <x-app-layout-table.th lablename="AVG_Attendance" />
                </x-app-layout-table.thead>
                <x-app-layout-table.tbody>
                    @if ($reportdata != null)
                        @foreach ($reportdata as $report)
                            <tr>
                                <x-app-layout-table.td> {{ $report->service_date }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $report->division_name }}</x-app-layout-table.td>
                                @if (request()->get('div_zone') == 'Zone')
                                    <x-app-layout-table.td> {{ $report->zone_name }}</x-app-layout-table.td>
                                @elseif (request()->get('div_zone') == 'Branch')
                                    <x-app-layout-table.td> {{ $report->church_name }}</x-app-layout-table.td>
                                @endif
                                <x-app-layout-table.td>{{ $report->female }} </x-app-layout-table.td>
                                <x-app-layout-table.td>{{ $report->male }} </x-app-layout-table.td>
                                <x-app-layout-table.td>{{ $report->children }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $report->avg_cell_attendance }}</x-app-layout-table.td>
                                <x-app-layout-table.td> {{ intval($report->attendanceAVG) }}
                                </x-app-layout-table.td>
                            </tr>
                        @endforeach
                    @endif


                </x-app-layout-table.tbody>
            </x-app-layout-table.table>

        </div>


    </div>
</x-app-layout>

<script>
    function HideButton(hideshow) {
        console.log('hide-function-hit');
        var x = document.getElementById("generateForm");
        if (hideshow === "hide") {
            x.style.display = "none";
        }


    }
</script>
