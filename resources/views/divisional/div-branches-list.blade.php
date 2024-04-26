<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full my-3">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">PCI Branches</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">



            <x-app-layout.flash />
            {{-- Report --}}
            <div class="md:flex md:justify-between">


                <div>
                    <form>

                        <div id="bulk-actions">
                            <label class="flex flex-wrap flex-row space-x-1">
                                <select id="church_status" name="church_status" onchange="HideButton('hide')"
                                    class="inline-block leading-5 relative py-2 ltr:pl-3 rtl:pr-3 pr-8 mb-3 rounded bg-gray-100 border border-gray-200 overflow-x-auto focus:outline-none focus:border-gray-300 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none">
                                    <option value="" data-dialog-content="">Select Report Option </option>
                                    @foreach ($select_opt as $opt)
                                        @if (request()->get('church_status') == $opt)
                                            <option selected value="{{ $opt }}">{{ $opt }}
                                            </option>
                                        @else
                                            <option value="{{ $opt }}">{{ $opt }}</option>
                                        @endif
                                    @endforeach
                                </select>



                                <select id="zone" name="zone" onchange="HideButton('hide')"
                                    class="inline-block leading-5 relative py-2 ltr:pl-3 rtl:pr-3 pr-8 mb-3 rounded bg-gray-100 border border-gray-200 overflow-x-auto focus:outline-none focus:border-gray-300 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none">
                                    <option value="" data-dialog-content="">Select Zone </option>
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
                    {{-- <form method="get" id="generateForm" action="/admin/reports/ajax/branches">
                        <input type="hidden" name="down_zone" value="{{ request()->get('zone') }}">
                        <input type="hidden" name="down_church_status" value="{{ request()->get('church_status') }}">
                        <button type="submit" style="display: {{ $truefalse }}"
                            class="py-2 px-4 mb-3 block lg:inline-block text-center rounded leading-5 text-gray-100 bg-pink-500 border border-ping-500 hover:text-white hover:bg-pink-600 hover:ring-0 hover:border-pink-600 focus:bg-pink-600 focus:border-pink-600 focus:outline-none focus:ring-0">
                            Download Report
                        </button>
                    </form> --}}

                </div>
            </div>
            <hr class="mb-4 ">

            <x-app-layout.flash />


            <x-app-layout-table.table class="hidden-header hidden-sort-after">
                <x-app-layout-table.thead>

                    @if (request()->get('div_zone') == 'Zone')
                        <x-app-layout-table.th lablename="Zone" />
                    @elseif (request()->get('div_zone') == 'Branch')
                        <x-app-layout-table.th lablename="Branch" />
                    @endif
                    <x-app-layout-table.th lablename="Branch_Name" />
                    <x-app-layout-table.th lablename="Branch_Pastor" />
                    <x-app-layout-table.th lablename="Location" />
                    <x-app-layout-table.th lablename="Address" />
                    
                    <x-app-layout-table.th lablename="Zone"  />
                    <x-app-layout-table.th lablename="Email" />
                    <x-app-layout-table.th lablename="Currency" />
                    <x-app-layout-table.th lablename="Country" />
                    <x-app-layout-table.th lablename="Year_Estb" />
                    <x-app-layout-table.th lablename="Status" />
                </x-app-layout-table.thead>
                <x-app-layout-table.tbody>
                    @if ($reportdata != null)
                        @foreach ($reportdata as $branch)
                            <tr>
                                <x-app-layout-table.td> {{ $branch->church_name }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $branch->branch_pastor }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $branch->church_location }} </x-app-layout-table.td>
                                <x-app-layout-table.td> {{ $branch->church_address }} </x-app-layout-table.td>
                             
                                <x-app-layout-table.td>
                                    {{ $branch->zone_name }} </x-app-layout-table.td>
                                <x-app-layout-table.td>{{ $branch->church_email }}</x-app-layout-table.td>
                                <x-app-layout-table.td>{{ $branch->currency }}</x-app-layout-table.td>
                                <x-app-layout-table.td>{{ $branch->country }}</x-app-layout-table.td>
                                <x-app-layout-table.td>{{ $branch->year_established }}</x-app-layout-table.td>
                                <x-app-layout-table.td>

                                    @if ($branch->church_status === 'Active')
                                        <x-app-layout-table.tt-green>
                                            {{ $branch->church_status }}
                                        </x-app-layout-table.tt-green>
                                    @else
                                        <x-app-layout-table.tt-red>
                                            {{ $branch->church_status }}
                                        </x-app-layout-table.tt-red>
                                    @endif

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
