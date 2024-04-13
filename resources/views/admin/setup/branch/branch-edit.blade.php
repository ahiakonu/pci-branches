<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Edit Branch </p>
            <x-app-layout.back-button href="{{ route('branches.index')}}" />

        </div>


        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">

            <div class="md:flex md:justify-between">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300 ">Edit Branch :
                    {{ $branch->church_name }}</h2>
            </div>

            <hr class="mb-4 ">

            <x-app-layout.flash />

            <form class="flex flex-wrap flex-row -mx-4" method="POST"
                action="{{ route('branches.update', $branch->id) }}"
                onsubmit="return SubmitFromAlert(this,'Update {{ $branch->church_name }}');">
                @csrf
                @method('PATCH')

                {{--  --}}
                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="church_name" lablename="Church Name"
                        :value="old('church_name', $branch->church_name)" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="church_location" lablename="Church Location"
                        :value="old('church_location', $branch->church_location)" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="church_email" lablename="Email Address"
                        :value="old('church_email', $branch->church_email)" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="church_address" lablename="Church Address"
                        :value="old('church_address', $branch->church_address)" input_required="false" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.label name="division_id" lablename="PCI Division" />
                    <x-app-layout-form.select-edit division_id="{{ old('division_id', $branch->division_id) }}"
                        :selectdata="$divisionsCombo"></x-app-layout-form.select-edit>
                    <x-app-layout-form.error name="division_id" />
                </x-app-layout.input-div>

                <input type="text" hidden id="old_zone" value="{{ old('zone_id',$branch->zone_id) }}" class="full-width">
                <x-app-layout-form.input-select class=" md:w-1/2 " name="zone_id" lablename="Division Zone" />

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="city" lablename="City Name" :value="old('city',$branch->city)" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/6 ">
                    <x-app-layout-form.input input_type="text" name="year_established" lablename="Year Established"
                        :value="old('year_established',$branch->year_established)" />
                </x-app-layout.input-div>

                <x-app-layout-form.input-select class=" md:w-1/3 " name="currency" lablename="Currency *">
                    @foreach ($currencies as $currency)
                        @if (old('currency',$branch->currency) == $currency)
                            <option value="{{ $currency }}" selected> {{ $currency }}
                            </option>
                        @else
                            <option value="{{ $currency }}"> {{ $currency }}
                            </option>
                        @endif
                    @endforeach
                </x-app-layout-form.input-select>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="website" lablename="Website" :value="old('website',$branch->website)"
                        input_required="false" />
                </x-app-layout.input-div>

                <x-app-layout-form.input-select class=" md:w-1/2 " name="church_status" lablename="Church Status">
                    @foreach ($churchStatus as $status)
                        @if (old('church_status',$branch->church_status) == $status)
                            <option value="{{ $status }}" selected> {{ $status }}
                            </option>
                        @else
                            <option value="{{ $status }}"> {{ $status }}
                            </option>
                        @endif
                    @endforeach
                </x-app-layout-form.input-select>
                {{--  --}}
                



          
                <div class="flex-shrink max-w-full px-4 w-full">
                    <x-app-layout-form.button> Update Branch
                    </x-app-layout-form.button>

                    <x-app-layout-form.button-clear style="float: right" />

                </div>
            </form>


        </div>
    </div>
</x-app-layout>
@include('components.app-layout-form.ajax-branch');