<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6 my-3">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">New Zonal Reporting</p>

            <x-app-layout.back-button href="{{ route('zonal.branch.reports',['year'=> request()->get('year'), 'month' => '']) }}" />

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

            <form class="flex flex-wrap flex-row -mx-4" method="POST" action="{{ route('zonal.zone.store') }}"
                onsubmit="return SubmitFromAlert(this,' Save zone report');">
                @csrf

                {{--  General Daily Meeting Info:: --}}

                <x-app-layout.input-div margin="mb-1 ">
                    <p class="text-indigo-600 ">
                        <x-app-svg.layout />
                        <strong>New Zonal Report ::</strong>
                    </p>
                </x-app-layout.input-div>

                <x-app-layout-form.gray-div>
                    {{--  --}}
                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="report_year" lablename="Reporting Year"
                            :value="request()->get('year')" disabled class="bg-gray-50" />
                    </x-app-layout.input-div>
                    <input type="hidden" name="report_year" value="{{ request()->get('year') }}">

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="report_month" lablename="Reporting Month"
                            :value="request()->get('month')" disabled class="bg-gray-50" />
                    </x-app-layout.input-div>
                    <input type="hidden" name="report_month" value="{{ request()->get('month') }}">

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="church" lablename="Seleched Branch"
                            :value="$church->church_name" disabled class="bg-gray-50" />
                    </x-app-layout.input-div>
                    <input type="hidden" name="branch_id" value="{{ $church->id }}">

                    {{--  --}}
                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="total_first_offering"
                            lablename="Total 1st Offering" :value="$findata->first_offering" disabled class="bg-gray-50" />
                    </x-app-layout.input-div>
                    <input type="hidden" name="total_first_offering" value="{{ $findata->first_offering }}">

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="total_tithe" lablename="Total Tithe"
                            :value="$findata->tithe" class="bg-gray-50" disabled />
                    </x-app-layout.input-div>
                    <input type="hidden" name="total_tithe" value="{{ $findata->tithe }}">

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="total_amalmagtion"
                            lablename="Total Amalgamation" :value="$findata->amalg" class="bg-gray-50" disabled />
                    </x-app-layout.input-div>

                    {{--  --}}
                    <x-app-layout-form.input-select class=" md:w-1/3 " name="branch_visited"
                        lablename="Did You Visit Branch ?">
                        @foreach ($yesno as $yn)
                            @if (old('branch_visited') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>

                    <x-app-layout-form.input-select class=" md:w-1/3 " name="pastor_follow_teaching"
                        lablename="Did Pastor Follow Teaching Plan ?">
                        @foreach ($yesno as $yn)
                            @if (old('pastor_follow_teaching') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>
                    <x-app-layout-form.input-select class=" md:w-1/3 " name="check_amalgamation"
                        lablename="Amalgamation Checked?">
                        @foreach ($yesno as $yn)
                            @if (old('check_amalgamation') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>



                    {{--  --}}



                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="amalgamation_paid"
                            lablename="Amalgamation Paid" :value="old('amalgamation_paid')" />
                    </x-app-layout.input-div>

                    <x-app-layout-form.input-select class=" md:w-1/3 " name="algamation_correct"
                        lablename="Was That The Correct Amount ?">
                        @foreach ($yesno as $yn)
                            @if (old('algamation_correct') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>


                    {{--  --}}
                    <x-app-layout-form.input-select class=" md:w-1/2 " name="attendance_inc_dec"
                        lablename="Church Attendance Increased/Decreased ?">
                        @foreach ($incdec as $yn)
                            @if (old('attendance_inc_dec') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>

                    <x-app-layout-form.input-select class=" md:w-1/2 " name="attendance_verified"
                        lablename="Attendance Verified ?">
                        @foreach ($yesno as $yn)
                            @if (old('attendance_verified') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>

                    {{--  --}}
                    <x-app-layout-form.input-select class=" md:w-1/2 " name="records_verified"
                        lablename="Have You Verified Attendance And Financial Records?">
                        @foreach ($yesno as $yn)
                            @if (old('records_verified') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>

                    <x-app-layout-form.input-select class=" md:w-1/2 " name="pastor_corporate"
                        lablename="Did Branch Pastor Corporate Wit You This Month ?">
                        @foreach ($yesno as $yn)
                            @if (old('pastor_corporate') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>

                    {{--  --}}
                    <x-app-layout.input-div class="  ">
                        <x-app-layout-form.textarea name="zonal_comments" lablename="Zonal Overseers Comment"
                            input_required="false">
                            {{ old('zonal_comments') }}
                        </x-app-layout-form.textarea>
                    </x-app-layout.input-div>

                </x-app-layout-form.gray-div>


                <div class="flex-shrink max-w-full px-4 w-full">
                    <x-app-layout-form.button> Save Zone Report
                    </x-app-layout-form.button>

                    <x-app-layout-form.button-clear style="float: right" />

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
