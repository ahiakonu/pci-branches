<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full my-3">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Branch Reports Details : Divisional Overseer</p>

            <x-app-layout.back-button
                href="{{ route('divisional.zone.reports', ['zone' => request()->get('zone'), 'year' => request()->get('year'), 'month' => '']) }}" />
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">



            <x-app-layout.flash />
            {{-- Report --}}
            <div class="md:flex md:justify-between">


                <div>
                    <form>

                        <div id="bulk-actions">
                            <label class="flex flex-wrap flex-row space-x-1">
                                <select id="zone" name="zone" onchange="HideButton('hide')" required
                                    class="inline-block leading-5 relative py-2 ltr:pl-3 rtl:pr-3 pr-8 mb-3 rounded bg-gray-100 border border-gray-200 overflow-x-auto focus:outline-none focus:border-gray-300 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none">
                                    <option value="" data-dialog-content="">Select Zone * </option>
                                    @foreach ($zones as $zn)
                                        @if (request()->get('zone') == $zn->id)
                                            <option selected value="{{ $zn->id }}">
                                                {{ $zn->zone_name }}
                                            </option>
                                        @else
                                            <option value="{{ $zn->id }}">{{ $zn->zone_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

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
                    <form method="get" id="generateForm" action="{{ route('divisional.branch.reports.download') }}">
                        <input type="hidden" name="down_zone" value="{{ request()->get('zone') }}">
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

            <x-app-layout-table.table class="hidden-header ">
                <x-app-layout-table.thead>

                    <x-app-layout-table.th lablename="Zone" />
                    <x-app-layout-table.th lablename="Branch" />
                    <x-app-layout-table.th lablename="Service_Date" />
                    <x-app-layout-table.th lablename="Service" />
                    <x-app-layout-table.th lablename="Month_&_Theme" />
                    <x-app-layout-table.th lablename="Attd(F+M+C)" />
                    <x-app-layout-table.th lablename="Preacher" />
                    <x-app-layout-table.th lablename="Cur" />
                    <x-app-layout-table.th lablename="Tithe" />
                    <x-app-layout-table.th lablename="1st_Offering" />
                    <x-app-layout-table.th lablename="Amalgamation" />
                    <x-app-layout-table.th lablename="Total_Income" />
                    <x-app-layout-table.th lablename="Cells" />
                    <x-app-layout-table.th lablename="Cell_Offering" />
                    <x-app-layout-table.th lablename="Submited_By" />
                    <x-app-layout-table.th data-sortable="false" lablename="Actions__" />

                </x-app-layout-table.thead>
                <x-app-layout-table.tbody>
                    @if ($reportdata != null)
                        @foreach ($reportdata as $report)
                            <tr>
                                <x-app-layout-table.td> {{ $report->zone_name }}</p></x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $report->church_name }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $report->service_date }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $report->service }}</x-app-layout-table.td>
                                <x-app-layout-table.td>{{ $report->theme_and_sermon }} </x-app-layout-table.td>
                                <x-app-layout-table.td>{{ $report->female + $report->male + $report->children }}
                                </x-app-layout-table.td>
                                <x-app-layout-table.td>{{ $report->name_of_preacher }} </x-app-layout-table.td>
                                <x-app-layout-table.td> <span
                                        class="text-sm text-red-500">{{ $report->currency }}</span>
                                </x-app-layout-table.td>
                                <x-app-layout-table.td> @fmoney($report->tithe) </x-app-layout-table.td>

                                <x-app-layout-table.td> @fmoney($report->first_offering) </x-app-layout-table.td>
                                <x-app-layout-table.td> @fmoney($report->amalgamation) </x-app-layout-table.td>
                                <x-app-layout-table.td>
                                    </span>@fmoney($report->tithe + $report->first_offering + $report->second_offering + $report->thanksgiving + $report->special_offering + $report->cell_offering)
                                </x-app-layout-table.td>
                                <x-app-layout-table.td>{{ $report->cells }} </x-app-layout-table.td>
                                <x-app-layout-table.td> @fmoney($report->cell_offering) </x-app-layout-table.td>
                                <x-app-layout-table.td>{{ $report->report_by }} </x-app-layout-table.td>
                                <x-app-layout-table.td>
                                    <div class="flex space-x-1">
                                        <a href="{{route('divisional.branch.report.show',$report->id)}}"
                                            {{-- onclick="SumitEdit('View report {{ $report->zone_name }}  {{ $report->report_month }}, {{ $report->report_year }} report ?','/divisional/branch/reports?zone={{ $report->zone_id }}&year={{ now()->year }}&month={{ $report->month_key }}')" --}}
                                            class="py-1 px-4 inline-block text-sm text-center mb-3 rounded leading-5
                                            text-indigo-500 bg-transparent border border-indigo-500 hover:text-gray-100
                                            hover:bg-indigo-500 hover:ring-0 hover:border-indigo-500 focus:text-gray-100
                                            focus:bg-indigo-500 focus:border-indigo-500 focus:outline-none focus:ring-0">
                                            view
                                        </a>
                                        <a href="javascript;;"
                                            onclick="SumitEdit('Update branch report {{ $report->church_name }}  {{ $report->service_date }} report ?','{{route('divisional.branch.report.edit',$report->id)}}')" 
                                            class="py-1 px-4 inline-block text-sm text-center mb-3 rounded leading-5
                                            text-green-500 bg-transparent border border-green-500 hover:text-gray-100
                                            hover:bg-green-500 hover:ring-0 hover:border-green-500 focus:text-gray-100
                                            focus:bg-green-500 focus:border-green-500 focus:outline-none focus:ring-0">
                                            edit
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
</x-app-layout>

<script>
    function HideButton(hideshow) {
        var x = document.getElementById("generateForm");
        if (hideshow === "hide") {
            x.style.display = "none";
        }
    }

    jQuery(document).ready(function($) {
        $loadval = $("#division_id").val();
        $loadval_id = $("#old_church").val();
        if ($loadval) {
            loadLocations($loadval, $loadval_id);
            // console.log('default load - region', division_id);
        }

        $("#division_id").on('change', function() {
            var division_id = $(this).val();
            loadLocations(division_id, 0);
        });
    });

    function loadLocations(division_id, loadval_id) {

        //console.log('in', division_id);
        $('#church_id').find('option').not(':first').remove();
        if (division_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/admin/reports/ajax/branches-by-divid',
                data: {
                    division_id: '' + division_id + ''
                },
                success: function(result, status) {
                    //console.log('result-',result.branches);
                    //console.log('status-',status);

                    if (result.status === true) {
                        var len = 0;
                        if (result.branches != null) {
                            len = result.branches.length;
                        }
                        if (len > 0) {
                            for (var i = 0; i < len; i++) {
                                var id = result.branches[i].id;
                                var zone = result.branches[i].church_name;

                                var option;
                                if (loadval_id.length > 0 && loadval_id == id) {
                                    //console.log('old-', loadval_id, 'zone-', location);
                                    option = "<option value='" + id + "' selected>" + zone +
                                        "</option>";
                                } else
                                    option = "<option value='" + id + "'>" + zone + "</option>";
                                $("#church_id").append(option);
                            }
                        }
                    } else {
                        // swal('Error',result.message,'error');
                        console.log('result', result)
                    }

                },
                error: function(xhr, desc, err) {
                    //swal('Error', err, 'error');
                }
            });
        } else {
            //clear content of Locations
        }
    }
</script>
