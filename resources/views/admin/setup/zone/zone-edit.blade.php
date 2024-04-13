<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Edit Zone </p>
            <x-app-layout.back-button href="/util/zones" />

        </div>


        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">

            <div class="md:flex md:justify-between">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300 ">Edit Zone :
                    {{ $zone->zone_name }}</h2>
            </div>

            <hr class="mb-4 ">

            <x-app-layout.flash />
            
            <form class="flex flex-wrap flex-row -mx-4" method="POST"
                action="{{ route('zones.update', $zone->id) }}"
                onsubmit="return SubmitFromAlert(this,'Update {{ $zone->zone_name }}');">
                @csrf
                @method('PATCH')


                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.label name="division_id" lablename="PCI Division" />
                    <x-app-layout-form.select-edit division_id="{{ old('division_id', $zone->division_id ) }}"
                        :selectdata="$divisionsCombo" ></x-app-layout-form.select-edit>
                    <x-app-layout-form.error name="division_id" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="zone_name" lablename="Zone Name"
                        :value="old('zone_name', $zone->zone_name)" />
                </x-app-layout.input-div>

                <x-app-layout.input-div>
                    <x-app-layout-form.input input_type="text" name="zonal_leader" lablename="Zonal Leader/Overseer"
                        :value="old('zonal_leader', $zone->zonal_leader)" />
                </x-app-layout.input-div>

                <div class="flex-shrink max-w-full px-4 w-full">
                    <x-app-layout-form.button> Update Zone
                    </x-app-layout-form.button>

                    <x-app-layout-form.button-clear style="float: right" />

                </div>
            </form>


        </div>
    </div>
</x-app-layout>
