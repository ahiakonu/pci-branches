<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Create Division</p>

            <x-app-layout.back-button href="/util/divisions" />
        </div>


        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">

            <div class="md:flex md:justify-between">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300 ">New Division</h2>
            </div>



            <hr class="mb-4 ">

            <x-app-layout.flash />

            <form class="flex flex-wrap flex-row -mx-4" method="POST" action="{{ route('divisions.store') }}"
            onsubmit="return SubmitFromAlert(this,' Create new division');">
                @csrf
                {{-- <x-app-layout-form.select class=" md:w-1/2 " name="region_id" lablename="LFU Region" :selectdata="$region_ToCombo" /> --}}
                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="division_name" lablename="Division Name"
                        :value="old('division_name')" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="country" lablename="Country" :value="old('country')" />
                </x-app-layout.input-div>

                <x-app-layout.input-div>
                    <x-app-layout-form.input input_type="text" name="divisional_leader" lablename="Divisional Leader/Overseer"
                        :value="old('divisional_leader')" />
                </x-app-layout.input-div>

                <div class="flex-shrink max-w-full px-4 w-full">

                    <x-app-layout-form.button> Save Division
                    </x-app-layout-form.button>

                    <x-app-layout-form.button-clear style="float: right" />

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
