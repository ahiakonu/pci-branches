<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Create Branch</p>

            <x-app-layout.back-button href="{{ route('branches.index')}}" />

        </div>


        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">

            <div class="md:flex md:justify-between">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300 ">New Branch</h2>
            </div>



            <hr class="mb-4 ">

            <x-app-layout.flash />

            <form class="flex flex-wrap flex-row -mx-4" method="POST" action="{{ route('branches.store') }}"
                onsubmit="return SubmitFromAlert(this,' Create new branch');">
                @csrf

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="church_name" lablename="Church Name *"
                        :value="old('church_name')" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="church_location" lablename="Church Location *"
                        :value="old('church_location')" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="church_email" lablename="Email Address *"
                        :value="old('church_email')" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="church_address" lablename="Church Address"
                        :value="old('church_address')" input_required="false" />
                </x-app-layout.input-div>

                <x-app-layout-form.select class=" md:w-1/2 " name="division_id" lablename="PCI Divisions *"
                    :selectdata="$divisionsCombo" />

                <input type="text" hidden id="old_zone" value="{{ old('zone_id') }}" class="full-width">
                <x-app-layout-form.input-select class=" md:w-1/2 " name="zone_id" lablename="Division Zone *" />

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="city" lablename="City Name" :value="old('city')" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/6 ">
                    <x-app-layout-form.input input_type="text" name="year_established" lablename="Year Established *"
                        :value="old('year_established')" />
                </x-app-layout.input-div>

                <x-app-layout-form.input-select class=" md:w-1/3 " name="currency" lablename="Currency *">
                    @foreach ($currencies as $currency)
                        @if (old('currency') == $currency)
                            <option value="{{ $currency }}" selected> {{ $currency }}
                            </option>
                        @else
                            <option value="{{ $currency }}"> {{ $currency }}
                            </option>
                        @endif
                    @endforeach
                </x-app-layout-form.input-select>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="website" lablename="Website" :value="old('website')"
                        input_required="false" />
                </x-app-layout.input-div>

                <x-app-layout-form.input-select class=" md:w-1/2 " name="church_status" lablename="Church Status *">
                    @foreach ($churchStatus as $status)
                        @if (old('church_status') == $status)
                            <option value="{{ $status }}" selected> {{ $status }}
                            </option>
                        @else
                            <option value="{{ $status }}"> {{ $status }}
                            </option>
                        @endif
                    @endforeach
                </x-app-layout-form.input-select>

                <div class="flex-shrink max-w-full px-4 w-full">
                    <x-app-layout-form.button> Create New Branch
                    </x-app-layout-form.button>

                    <x-app-layout-form.button-clear style="float: right" />

                </div>
            </form>
        </div>
    </div>
</x-app-layout>

@include('components.app-layout-form.ajax-branch');
