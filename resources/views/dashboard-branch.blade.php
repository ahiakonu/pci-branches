<x-app-layout>
    <div class="px-4">
        @php
            //dd($target);
            if ($target->count() > 0) {
                $tag = $target[0];
            } else {
                $tag = (object) ['income' => 1, 'attendance' => 1];
            }
        @endphp
        {{-- row 1 --}}
        <div class="flex flex-wrap flex-row">
            <div class="flex-shrink max-w-full px-4 w-full">
                <p class="text-xl font-bold mt-3 mb-5">Branch Pastor</p>
            </div>


            {{-- Reports --}}
            <div class="flex-shrink max-w-full px-4 w-full sm:w-1/3 lg:w-1/3 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6 relative overflow-hidden">
                    <h3 class="text-base font-bold mb-2">Reports Submitted in {{ now()->year }}</h3>

                    <div class="relative text-center">
                        <h2 class="text-3xl font-bold mb-4">{{ $dash['reports_count'] }}</h2>
                    </div>

                    <div class="flex flex-row justify-between w-full">

                        <div class="flex items-center text-green-500">
                            <a class="text-sm mb-3 hover:text-indigo-500 " href="/branch/branchreport">View more..
                                </span></a>

                        </div>
                    </div>


                    <!-- bg circle -->
                    <div class="absolute ltr:-right-16 rtl:-left-16 -top-16">
                        <div class="bg-red-500 opacity-10 w-36 h-36 rounded-full shadow-lg shadow-red-500/10"></div>
                    </div>
                    <div class="absolute ltr:-right-4 rtl:-left-4 -top-24">
                        <div class="bg-red-500 opacity-10 w-36 h-36 rounded-full shadow-lg shadow-red-500/10"></div>
                    </div>
                </div>
            </div>

            {{--   --}}
            <div class="flex-shrink max-w-full px-4 w-full sm:w-1/3 lg:w-1/3 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6 relative overflow-hidden">
                    <h3 class="text-base font-bold mb-2">Message Board</h3>

                    <!-- target -->
                    <div class="relative text-center">
                        <h2 class="text-3xl font-bold mb-4"></h2>
                        <a class="text-sm  hover:underline " href="">View more.. </span></a>
                    </div>

                    <!-- bg circle -->
                    <div class="absolute ltr:-right-16 rtl:-left-16 -top-16">
                        <div class="bg-green-500 opacity-10 w-36 h-36 rounded-full shadow-lg shadow-indigo-500/10">
                        </div>
                    </div>
                    <div class="absolute ltr:-right-4 rtl:-left-4 -top-24">
                        <div class="bg-green-500 opacity-10 w-36 h-36 rounded-full shadow-lg shadow-indigo-500/10">
                        </div>
                    </div>
                </div>
            </div>

            {{--   --}}
            <div class="flex-shrink max-w-full px-4 w-full sm:w-1/3 lg:w-1/3 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6 relative overflow-hidden">
                    <h3 class="text-base font-bold mb-2">Admin Documents</h3>

                    <!-- target -->
                    <div class="relative text-center">
                        <h2 class="text-3xl font-bold mb-4"> {{ $downloads }}</h2>
                        <a class="text-sm  hover:underline " href=" {{route('noticeboard.documentDownloads')}} ">View more..
                            </span></a>
                    </div>



                    <!-- bg circle -->
                    <div class="absolute ltr:-right-16 rtl:-left-16 -top-16">
                        <div class="bg-pink-500 opacity-10 w-36 h-36 rounded-full shadow-lg shadow-indigo-500/10"></div>
                    </div>
                    <div class="absolute ltr:-right-4 rtl:-left-4 -top-24">
                        <div class="bg-pink-500 opacity-10 w-36 h-36 rounded-full shadow-lg shadow-indigo-500/10"></div>
                    </div>
                </div>
            </div>

        </div>


        {{-- row 2 --}}
        @php
            if ($target->count() > 0) {
                $income = (float) $tag->income;
                $income_sum = $dash['sum_income']->sum_income;
                $percent_income = round(100 * ($income_sum / $income), 2);
                $display_inc = $percent_income > 100 ? 100 : $percent_income;

                // echo $percent_income;

                $attendance = (int) $tag->attendance;
                $attendance_sum = $dash['avg_attendance']->avg_attendance;
                $percent_attendance = round(100 * ($attendance_sum / $attendance), 2);
                $display_att = $percent_attendance > 100 ? 100 : $percent_attendance;
            } else {
                $income = (float) $tag->income;
                $income_sum = $dash['sum_income']->sum_income;
                $percent_income = 0;
                $display_inc = 0;

                // echo $percent_income;

                $attendance = (int) $tag->attendance;
                $attendance_sum = $dash['avg_attendance']->avg_attendance;
                $percent_attendance = 0;
                $display_att = 0;
            }

        @endphp

        <div class="flex flex-wrap flex-row">
            {{-- income target --}}


            <div class="flex-shrink max-w-full px-4 w-full lg:w-1/2 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6">
                    <div class="flex flex-row justify-between pb-3">
                        <div class="flex flex-col">
                            <a href="{{ route('branch.report_analysis') }}">
                                <h3 class="text-base font-bold">Monthly Income</h3>
                            </a>
                        </div>
                    </div>
                    <div class="relative">
                        <h4 class="font-bold text-2xl text-green-500 mb-3">{{ $branch->currency }}
                            @fmoney($dash['sum_income']->sum_income) ({{ $percent_income }}%)</h4>
                        <div class="w-full h-4 bg-green-100 rounded-full mt-2">
                            <div class="h-full text-center text-xs text-white bg-green-500 rounded-full"
                                style="width:{{ $display_inc }}%">
                                <span class="text-xs text-white text-center">{{ $percent_income }}%</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-3">Target : {{ $branch->currency }} @fmoney($tag->income) </p>
                    </div>
                </div>
            </div>
            {{-- attendance target --}}

            <div class="flex-shrink max-w-full px-4 w-full lg:w-1/2 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6">
                    <div class="flex flex-row justify-between pb-3">
                        <div class="flex flex-col">
                            <h3 class="text-base font-bold">Weekly Attendance</h3>
                        </div>
                        {{--    <div x-data="{ open: false }" class="relative">
                        <button @click="open = ! open"
                            class="text-gray-500 hover:text-gray-600 dark:hover:text-gray-400 transition-colors duration-200 focus:outline-none hover:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="w-6 h-6 bi bi-three-dots" viewBox="0 0 16 16">
                                <path
                                    d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z">
                                </path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="origin-top-right absolute ltr:right-0 rtl:left-0 rounded rounded-t-non bg-white dark:bg-gray-800 z-10 rounded border border-gray-200 dark:border-gray-700"
                            style="min-width: 12rem; display: none;">
                            <a class="block px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:focus:bg-gray-900"
                                href="#">Daily</a>
                            <a class="block px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:focus:bg-gray-900"
                                href="#">Weekly</a>
                            <a class="block px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:focus:bg-gray-900"
                                href="#">Yearly</a>
                        </div>
                    </div> --}}
                    </div>
                    <div class="relative">
                        <h4 class="font-bold text-2xl text-pink-500 mb-3">{{ (int) $attendance_sum }}
                            ({{ $percent_attendance }}%)</h4>
                        <div class="w-full h-4 bg-pink-100 rounded-full mt-2">
                            <div class="h-full text-center text-xs text-white bg-pink-500 rounded-full"
                                style="width:{{ $display_att }}%">
                                <span class="text-xs text-white text-center">{{ $percent_attendance }}%</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-3">Target : {{ $tag->attendance }}</p>
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
                    <x-app-layout-table.th lablename="Tot_Income" />
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
                            <x-app-layout-table.td> <span class="text-sm text-red-500">{{ $tt->currency }}</span>
                            </x-app-layout-table.td>
                            <x-app-layout-table.td> @fmoney($tt->total_income)</x-app-layout-table.td>
                            <x-app-layout-table.td> @fmoney($tt->amalgamation)</x-app-layout-table.td>
                            <x-app-layout-table.td> {{ $tt->service }} </x-app-layout-table.td>
                            <x-app-layout-table.td> {{ $tt->theme_and_sermon }} </x-app-layout-table.td>
                            <x-app-layout-table.td> {{ $tt->name_of_preacher }} </x-app-layout-table.td>
                            <x-app-layout-table.td>
                                <div class="flex">
                                    <x-app-layout.tooltip-header>
                                        <a href="javascript:;" x-on:mouseover="tooltips = true"
                                            x-on:mouseleave="tooltips = false"
                                            onclick="SumitEdit('View my {{ $tt->service_date }}  {{ $tt->service }} report ?','/branch/branchreport/{{ $tt->id }}')"
                                            class="inline-block ltr:mr-2 rtl:ml-2 hover:text-green-500">
                                            <x-app-svg.openfolder />
                                            <x-app-layout.tooltip-details tooltip_label="details" />
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
