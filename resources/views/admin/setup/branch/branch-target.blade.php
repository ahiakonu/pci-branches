<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Branch Target</p>
            <x-app-layout.back-button href="/admin/setup/branches" />

        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full  mb-6">
            <div
                class="p-6 mb-6 border border-gray-200 bg-gray-100 dark:bg-gray-900 dark:border-gray-800 dark:bg-opacity-20">


                <div class="md:flex md:justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-indigo-500 ">
                        {{ $branch->church_name }}</h2>
                </div>

                <hr class="mb-4 ">
                <div class="flex flex-wrap flex-row -mx-4">

                    {{--  --}}
                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="church_name" lablename="Church Name"
                            :value="$branch->church_name" disabled class="bg-gray-200" />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="church_location" lablename="Church Location"
                            :value="$branch->church_location" disabled class="bg-gray-200" />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="church_email" lablename="Email Address"
                            :value="$branch->church_email" disabled class="bg-gray-200" />
                    </x-app-layout.input-div>

                </div>
            </div>

        </div>

        <div x-data="{ open: false }">
            <p class="flex">
                <button @click="open=!open"
                    class="mb-4 py-2 px-4 inline-block text-center rounded leading-5 text-gray-100 bg-indigo-500 border border-indigo-500 hover:text-white hover:bg-indigo-600 hover:ring-0 hover:border-indigo-600 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0"
                    type="button">
                    Create/Update Target
                </button>
            </p>

            <div x-show="open"
                class="border px-4 py-3 my-2 dark:border-gray-900 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full  mb-6">
                <x-app-layout.flash />

                <form class="flex flex-wrap flex-row -mx-4" method="POST"
                    action="{{ route('admin.branch.resetTarget', $branch->id) }}"
                    onsubmit="return SubmitFromAlert(this,'Save target for {{ $branch->church_name }}');">
                    @csrf
                    {{-- <x-app-layout-form.select class=" md:w-1/2 " name="region_id" lablename="LFU Region" :selectdata="$region_ToCombo" /> --}}
                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" class="bg-gray-200" lablename="Currency"
                            :value="$branch->currency" name="currency" disabled />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="income"
                            lablename="Expected Income *" :value="old('income')" step='0.01' />
                    </x-app-layout.input-div>

                    <x-app-layout-form.input-select class=" md:w-1/3 " name="income_criteria"
                        lablename="Offering Criteria *">
                        @foreach ($target_criteria as $criteria)
                            @if (old('income_criteria') == $criteria)
                                <option value="{{ $criteria }}" selected> {{ $criteria }}
                                </option>
                            @else
                                <option value="{{ $criteria }}"> {{ $criteria }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>


                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="number" min="0" name="attendance"
                            lablename="Average Attendance *" :value="old('attendance')" />
                    </x-app-layout.input-div>

                    <x-app-layout-form.input-select class=" md:w-1/3 " name="attendance_criteria"
                        lablename="Attendance Criteria *">
                        @foreach ($target_criteria as $criteria)
                            @if (old('attendance_criteria') == $criteria)
                                <option value="{{ $criteria }}" selected> {{ $criteria }}
                                </option>
                            @else
                                <option value="{{ $criteria }}"> {{ $criteria }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>


                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="target_year" lablename="Target Year *"
                            :value="old('target_year', date('Y'))" />
                    </x-app-layout.input-div>

                    <input type="hidden" name="maker_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="church_name" value="{{ $branch->church_name }}">
                    <input type="hidden" name="branch_id" value="{{ $branch->id }} ">


                    <div class="flex-shrink max-w-full px-4 w-full">
                        <x-app-layout-form.button> Save Target
                        </x-app-layout-form.button>
                        <x-app-layout-form.button-clear style="float: right" />

                    </div>
                </form>
            </div>
        </div>



        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">

            <div class="md:flex md:justify-between">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-indigo-500 ">
                    Targer History</h2>
            </div>

            <hr class="mb-4 ">

            <x-app-layout.flash />

            <x-app-layout-table.table class="hidden-header hidden-sort-after">
                <x-app-layout-table.thead>
                    <x-app-layout-table.th lablename="Attendance" />
                    <x-app-layout-table.th lablename="Attd. Criteria" />
                    <x-app-layout-table.th lablename="Income" />
                    <x-app-layout-table.th lablename="Inc. Criteria" />
                    <x-app-layout-table.th lablename="Target Year" />
                    <x-app-layout-table.th data-sortable="false" lablename="Actions" />
                </x-app-layout-table.thead>
                <x-app-layout-table.tbody>
                    @foreach ($targets as $tt)
                        <tr>
                            <x-app-layout-table.td> {{ $tt->attendance }} </x-app-layout-table.td>
                            <x-app-layout-table.td> {{ $tt->attendance_criteria }} </x-app-layout-table.td>
                            <x-app-layout-table.td> <span class="text-sm text-red-400">{{$branch->currency}}</span>
                                    @fmoney($tt->income) </x-app-layout-table.td>
                            <x-app-layout-table.td> {{ $tt->income_criteria }} </x-app-layout-table.td>
                            <x-app-layout-table.td> {{ $tt->target_year }}</x-app-layout-table.td>

                            <x-app-layout-table.td>
                                <div class="flex">

                                    <form action="{{ route('admin.branch.destroyTarget', $tt->id) }}" method="post"
                                        onsubmit="return SubmitDelete(this,'Delete {{ $tt->target_year }} target');">
                                        @csrf
                                        @method('delete')
                                        <x-app-layout.tooltip-header>
                                            <button type="submit" x-on:mouseover="tooltips = true"
                                                x-on:mouseleave="tooltips = false"
                                                class="inline-block ltr:mr-2 rtl:ml-2 hover:text-red-500">
                                                <x-app-svg.delete />
                                                <x-app-layout.tooltip-details tooltip_label="Delete" />
                                            </button>
                                        </x-app-layout.tooltip-header>
                                    </form>

                                </div>
                            </x-app-layout-table.td>
                        </tr>
                    @endforeach

                </x-app-layout-table.tbody>
            </x-app-layout-table.table>

        </div>
    </div>
</x-app-layout>
