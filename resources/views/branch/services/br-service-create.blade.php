<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6 my-3">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Service Reporting</p>

            <x-app-layout.back-button href="/branch/branchreport" />

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

            <form class="flex flex-wrap flex-row -mx-4" method="POST" action="{{ route('branchreport.store') }}"
                onsubmit="return SubmitFromAlert(this,' Save branch report');">
                @csrf

                {{--  General Daily Meeting Info:: --}}
                <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                <x-app-layout.input-div margin="mb-1 ">
                    <p class="text-indigo-600 ">
                        <x-app-svg.layout />
                        General Daily Meeting Info::
                    </p>
                </x-app-layout.input-div>
                <x-app-layout-form.gray-div>
                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="text" name="church_name" lablename="Church Name"
                            class="bg-gray-50" value="{{ $branch->church_name }}" disabled />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="text" name="church_division" lablename="Division *"
                            class="bg-gray-50" value="{{ $branch->division->division_name }}" disabled />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.date lablename="Service Date *" name="service_date" :value="old('service_date')" />
                    </x-app-layout.input-div>


                    <x-app-layout-form.input-select class=" md:w-1/2 " name="service_id" lablename="Service *">
                        @foreach ($services as $service)
                            @if (old('service_id') == $service->id)
                                <option value="{{ $service->id }}" selected> {{ $service->service }}
                                </option>
                            @else
                                <option value="{{ $service->id }}"> {{ $service->service }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>

                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="text" name="name_of_preacher"
                            lablename="Name of Preacher *" :value="old('name_of_preacher')" />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="text" name="theme_and_sermon"
                            lablename="Theme Of Month, Sermon Title *" :value="old('theme_and_sermon')" />
                    </x-app-layout.input-div>
                </x-app-layout-form.gray-div>
                {{--  //General Daily Meeting Info:: --}}

                {{-- Offering and Income --}}
                <x-app-layout.input-div margin="mb-1 ">
                    <p> <span class="text-indigo-600 ">
                            <x-app-svg.layout />
                            Offering/Income Info ::
                        </span><span class="text-red-400">
                            {{ $branch->currency }}
                        </span> </p>
                </x-app-layout.input-div>
                <x-app-layout-form.gray-div>


                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="tithe" lablename="Tithe *"
                            :value="old('tithe', 0)" step='0.01' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="first_offering"
                            lablename="First Offering *" :value="old('first_offering', 0)" step='0.01' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="second_offering"
                            lablename="Second Offering *" :value="old('second_offering', 0)" step='0.01' />
                    </x-app-layout.input-div>


                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="thanksgiving"
                            lablename="Thanksgiving" :value="old('thanksgiving', 0)" step='0.01' input_required="false" />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="special_offering"
                            lablename="Special Offering " :value="old('special_offering', 0)" step='0.01' input_required="false" />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class="">
                        <x-app-layout-form.input input_type="text" name="other_donations_cash_or_kind"
                            lablename="Other Donations In Cash or Kind" :value="old('other_donations_cash_or_kind')" input_required="false" />
                    </x-app-layout.input-div>
                </x-app-layout-form.gray-div>
                {{-- //Offering and Income --}}

                {{-- Attendance info --}}
                <x-app-layout.input-div margin="mb-1 ">
                    <p class="text-indigo-600 ">
                        <x-app-svg.layout />
                        Attendance & Other Info ::</span>
                    </p>
                </x-app-layout.input-div>
                <x-app-layout-form.gray-div>
                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="female" lablename="Female *"
                            :value="old('female', 0)" step='1' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="male" lablename="Male *"
                            :value="old('male', 0)" step='1' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="children"
                            lablename="Children *" :value="old('children', 0)" step='1' />
                    </x-app-layout.input-div>


                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="visitors"
                            lablename="Visitors/Converts" :value="old('visitors', 0)" step='1' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="souls_won"
                            lablename="Souls Won" :value="old('souls_won', 0)" step='1' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="water_baptised"
                            lablename="Water Baptised" :value="old('water_baptised', 0)" step='1' />
                    </x-app-layout.input-div>


                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="holy_ghost_baptised"
                            lablename="Holy Ghost Baptised" :value="old('holy_ghost_baptised', 0)" step='1' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="people_inducted"
                            lablename="People Inducted" :value="old('people_inducted', 0)" step='1' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="weddings"
                            lablename="Weddings Conducted" :value="old('weddings', 0)" step='1' />
                    </x-app-layout.input-div>


                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="births"
                            lablename="Births" :value="old('births', 0)" step='1' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="children_named"
                            lablename="Children Named" :value="old('children_named', 0)" step='1' />
                    </x-app-layout.input-div>
                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="children_dedicated"
                            lablename="Children Dedicated" :value="old('children_dedicated', 0)" step='1' />
                    </x-app-layout.input-div>


                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="deaths"
                            lablename="Deaths" :value="old('deaths', 0)" step='1' />
                    </x-app-layout.input-div>
                    <x-app-layout.input-div class="md:w-1/2">
                        <x-app-layout-form.input input_type="text" name="special_programs_in_week"
                            lablename="Special Program In The Week" :value="old('special_programs_in_week')" input_required="false" />
                    </x-app-layout.input-div>


                    <x-app-layout.input-div class="md:w-1/2">
                        <x-app-layout-form.input input_type="text" name="issues_or_comments"
                            lablename="Any Issues or Comments" :value="old('issues_or_comments')" input_required="false" />
                    </x-app-layout.input-div>
                    <x-app-layout.input-div class="md:w-1/2">
                        <x-app-layout-form.input input_type="text" name="report_by" lablename="Report Submitted By *"
                            :value="old('report_by')" />
                    </x-app-layout.input-div>
                </x-app-layout-form.gray-div>
                {{-- // attendance info --}}

                {{-- Cell Info --}}
                <x-app-layout.input-div margin="mb-1 ">
                    <p class="text-indigo-600 ">
                        <x-app-svg.layout /> LFU Details ::</span>
                    </p>
                </x-app-layout.input-div>
                <x-app-layout-form.gray-div>
                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="number" min="0" name="cells"
                            lablename="No. of Cells *" :value="old('cells', 0)" step='1' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="number" min="0" name="cells_met"
                            lablename="No. Cells That Met *" :value="old('cells_met', 0)" step='1' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="number" min="0" name="avg_cell_attendance"
                            lablename="Avg. Cell Attendance *" :value="old('avg_cell_attendance', 0)" step='1' />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="number" min="0" name="cell_offering"
                            lablename="Total Cell Offering *" :value="old('cell_offering', 0)" step='0.01' />
                    </x-app-layout.input-div>
                </x-app-layout-form.gray-div>
                {{-- //Cell Info --}}


                <div class="flex-shrink max-w-full px-4 w-full">
                    <x-app-layout-form.button> Save Branch Report
                    </x-app-layout-form.button>

                    <x-app-layout-form.button-clear style="float: right" />

                </div>
            </form>
        </div>
    </div>
</x-app-layout>

@include('components.app-layout-form.ajax-branch');
