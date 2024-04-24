<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6 my-3">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">View Zonal Report</p>

            <x-app-layout.back-button
                href="{{ route('zonal.zone.index', ['year' => $report->report_year, 'month' => '']) }}" />

        </div>


        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
            <x-app-layout.flash />
            @if ($errors->any())
                <div x-data="{ open: true }" x-show="open"
                    class="flex justify-between items-center relative bg-red-100 text-red-900 py-3 px-6 rounded mb-4">

                    <div class="pristine-error text-help text-sm text-red-600">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <button type="button" @click="open = false">
                        <span class="text-2xl">×</span>
                    </button>
                </div>




            @endif



            {{--  General Daily Meeting Info:: --}}

            <x-app-layout.input-div margin="mb-1 ">
                <p class="text-indigo-600 ">
                    <x-app-svg.layout />
                    <strong> {{$church->church_name}} : {{ $report->report_month }}, {{ $report->report_year}} </strong>
                </p>
            </x-app-layout.input-div>

            <x-app-layout-form.gray-div>
                {{--  --}}
                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="report_year" lablename="Reporting Year"
                        value="{{ $report->report_year }}" disabled class="bg-gray-50" />
                </x-app-layout.input-div>


                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="report_month" lablename="Reporting Month"
                        value="{{ $report->report_month }}" disabled class="bg-gray-50" />
                </x-app-layout.input-div>


                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="church" lablename="Seleched Branch"
                        :value="$church->church_name" disabled class="bg-gray-50" />
                </x-app-layout.input-div>


                {{--  --}}
                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="total_first_offering"
                        lablename="Total 1st Offering" :value="$findata->first_offering" disabled class="bg-gray-50" />
                </x-app-layout.input-div>


                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="total_tithe" lablename="Total Tithe"
                        :value="$findata->tithe" class="bg-gray-50" disabled />
                </x-app-layout.input-div>


                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="total_amalmagtion" lablename="Total Amalgamation"
                        :value="$findata->amalg" class="bg-gray-50" disabled />
                </x-app-layout.input-div>

                {{--  --}}
                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="branch_visited" lablename="Did You Visit Branch ?"
                        value="{{ $report->branch_visited }}" disabled class="bg-gray-50" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="pastor_follow_teaching"
                        lablename="Did Pastor Follow Teaching Plan ?" value="{{ $report->pastor_follow_teaching }}"
                        disabled class="bg-gray-50" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="check_amalgamation"
                        lablename="Amalgamation Checked?" value="{{ $report->check_amalgamation }}" disabled
                        class="bg-gray-50" />
                </x-app-layout.input-div>



                {{--  --}}
                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="amalgamation_paid" lablename="Amalgamation Paid"
                        value="{{ $report->amalgamation_paid }}" disabled class="bg-gray-50" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="algamation_correct"
                        lablename="Was That The Correct Amount ?" value="{{ $report->algamation_correct }}" disabled
                        class="bg-gray-50" />
                </x-app-layout.input-div>



                {{--  --}}
                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="attendance_inc_dec"
                        lablename="Church Attendance Increased/Decreased ?" value="{{ $report->attendance_inc_dec }}"
                        disabled class="bg-gray-50" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="attendance_verified"
                        lablename="Attendance Verified ?" value="{{ $report->attendance_verified }}" disabled
                        class="bg-gray-50" />
                </x-app-layout.input-div>


                {{--  --}}
                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="records_verified"
                        lablename="Have You Verified Attendance And Financial Records?"
                        value="{{ $report->records_verified }}" disabled class="bg-gray-50" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2">
                    <x-app-layout-form.input input_type="text" name="pastor_corporate"
                        lablename="Did Branch Pastor Corporate Wit You This Month ?"
                        value="{{ $report->pastor_corporate }}" disabled class="bg-gray-50" />
                </x-app-layout.input-div>



                {{--  --}}
                <x-app-layout.input-div class="  ">
                    <x-app-layout-form.textarea name="zonal_comments" lablename="Zonal Overseers Comment"
                        input_required="false" disabled class="bg-gray-50">
                        {{ $report->zonal_comments }}
                    </x-app-layout-form.textarea>
                </x-app-layout.input-div>

            </x-app-layout-form.gray-div>




        </div>
    </div>
</x-app-layout>
