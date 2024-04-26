<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6 my-3">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">New Divisional Reporting</p>

            <x-app-layout.back-button
                href="{{ route('divisional.divisional.index', ['year' => request()->get('year')]) }}" />

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

            <form class="flex flex-wrap flex-row -mx-4" method="POST"
                action="{{ route('divisional.divisional.store') }}"
                onsubmit="return SubmitFromAlert(this,' Save divisional report');">
                @csrf

                {{--  General Daily Meeting Info:: --}}

                <x-app-layout.input-div margin="mb-1 ">
                    <p class="text-indigo-600 ">
                        <x-app-svg.layout />
                        <strong>New Divisional Report ::</strong>
                    </p>
                </x-app-layout.input-div>

                <x-app-layout-form.gray-div>
                    {{--  --}}
                    <x-app-layout-form.input-select class=" sm:w-1/2 lg:w-1/2 " name="report_year"
                        lablename="Reporting Year"  >
                        @foreach ($years as $yn)
                            @if (old('report_year') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>

                    <x-app-layout-form.input-select class=" sm:w-1/2 lg:w-1/2 " name="report_month"
                        lablename="Reporting Month">
                        @foreach ($months as $yn)
                            @if (old('report_month') == $yn)
                                <option value="{{ $yn['monthkey'] }}" selected> {{ $yn['month'] }}
                                </option>
                            @else
                                <option value="{{ $yn['monthkey'] }}"> {{ $yn['month'] }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>


                    {{-- 'visit_any_branch',  'branches_visisted',  --}}
                    <x-app-layout-form.input-select class=" sm:w-1/4 lg:w-1/4 " name="visit_any_branch"
                        lablename="Did You Visit Any Branch ?" >
                        @foreach ($yesno as $yn)
                            @if (old('visit_any_branch') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>
                    <x-app-layout.input-div class=" sm:w-3/4 lg:w-3/4  ">
                        <x-app-layout-form.input input_type="text" name="branches_visisted"
                            lablename="If Yes, Name of Branch(es) Visisted" :value="old('branches_visisted')" />
                    </x-app-layout.input-div>

                    {{-- 'branches_paid_amalg','branches_not_paid_amalg_details',,  --}}
                    <x-app-layout-form.input-select class=" sm:w-1/4 lg:w-1/4 " name="branches_paid_amalg"
                        lablename="Have All Branch(es) Paid Amalg. ?" >
                        @foreach ($yesno as $yn)
                            @if (old('branches_paid_amalg') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>
                    <x-app-layout.input-div class=" sm:w-3/4 lg:w-3/4  ">
                        <x-app-layout-form.input input_type="text" name="branches_not_paid_amalg_details"
                            lablename="If No, Give Details" :value="old('branches_not_paid_amalg_details')" input_required='false'/>
                    </x-app-layout.input-div>


                    {{-- 'sent_amalg','not_sent_amalg_details',  --}}
                    <x-app-layout-form.input-select class=" sm:w-1/4 lg:w-1/4 " name="sent_amalg"
                        lablename="Have You Sent Amalgamation ?" >
                        @foreach ($yesno as $yn)
                            @if (old('sent_amalg') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>
                    <x-app-layout.input-div class=" sm:w-3/4 lg:w-3/4  ">
                        <x-app-layout-form.input input_type="text" name="not_sent_amalg_details"
                            lablename="If No, Why ?" :value="old('not_sent_amalg_details')" nput_required='false'/>
                    </x-app-layout.input-div>

                    {{--  'amalg_defaults','amalg_defaults_branches' --}}
                    <x-app-layout-form.input-select class="sm:w-1/4 lg:w-1/4  " name="amalg_defaults"
                        lablename="Where There Defaults/Underpayments?" >
                        @foreach ($yesno as $yn)
                            @if (old('amalg_defaults') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>
                    <x-app-layout.input-div class=" sm:w-3/4 lg:w-3/4  ">
                        <x-app-layout-form.input input_type="text" name="amalg_defaults_branches"
                            lablename="If No, Which Branches ?" :value="old('amalg_defaults_branches')" nput_required='false'/>
                    </x-app-layout.input-div>

                    {{-- 'amalg_defaults_action', --}}
                    <x-app-layout.input-div class="  ">
                        <x-app-layout-form.textarea name="amalg_defaults_action" lablename="What Action Was Taken ?"
                            input_required="false">
                            {{ old('amalg_defaults_action') }}
                        </x-app-layout-form.textarea>
                    </x-app-layout.input-div>


                    {{--  'compliance_issues', --}}
                    <x-app-layout-form.input-select class=" " name="compliance_issues"
                        lablename="Any Compliance Issues In Division ? (eg. Preaching Plan, Special Dates, etc)"
                        >
                        @foreach ($yesno as $yn)
                            @if (old('compliance_issues') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>
                    {{-- 'compliance_issues_details', --}}
                    <x-app-layout.input-div class="  ">
                        <x-app-layout-form.textarea name="compliance_issues_details" lablename="If Yes, Give Details"
                            input_required="false">
                            {{ old('compliance_issues_details') }}
                        </x-app-layout-form.textarea>
                    </x-app-layout.input-div>


                    {{--  'divisional_programs', --}}
                    <x-app-layout-form.input-select class=" " name="divisional_programs"
                        lablename="Where There Divisional Programs/Meetings ?" >
                        @foreach ($yesno as $yn)
                            @if (old('divisional_programs') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>
                    {{-- 'divisional_ptogram_details', --}}
                    <x-app-layout.input-div class="  ">
                        <x-app-layout-form.textarea name="divisional_ptogram_details" lablename="If Yes, Give Details"
                            input_required="false">
                            {{ old('divisional_ptogram_details') }}
                        </x-app-layout-form.textarea>
                    </x-app-layout.input-div>

 
                    {{--  'all_branches_attended', --}}
                    <x-app-layout-form.input-select class=" " name="all_branches_attended"
                        lablename="Did All Branch Pastors Attend ?" required>
                        @foreach ($yesno as $yn)
                            @if (old('all_branches_attended') == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>
                    {{-- 'all_branches_attended_details', --}}
                    <x-app-layout.input-div class="  ">
                        <x-app-layout-form.textarea name="all_branches_attended_details" lablename="If Yes, Give Details"
                            input_required="false">
                            {{ old('all_branches_attended_details') }}
                        </x-app-layout-form.textarea>
                    </x-app-layout.input-div>

 
                </x-app-layout-form.gray-div>


                <div class="flex-shrink max-w-full px-4 w-full">
                    <x-app-layout-form.button> Save Divisional Report
                    </x-app-layout-form.button>

                    <x-app-layout-form.button-clear style="float: right" />

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
