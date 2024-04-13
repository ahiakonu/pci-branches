<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Edit Division </p>
            <x-app-layout.back-button href="/util/divisions" />

        </div>


        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">

            <div class="md:flex md:justify-between">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300 ">Edit Division :
                    {{ $division->division_name }}</h2>
            </div>

            <hr class="mb-4 ">

            <x-app-layout.flash />
            
            <form class="flex flex-wrap flex-row -mx-4" method="POST"
                action="{{ route('divisions.update', $division->id) }}"
                onsubmit="return SubmitFromAlert(this,'Update {{ $division->division_name }}');">
                @csrf
                @method('PATCH')


                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="division_name" lablename="Division Name"
                        :value="old('division_name', $division->division_name)" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/2 ">
                    <x-app-layout-form.input input_type="text" name="country" lablename="Country" :value="old('country', $division->country)" />
                </x-app-layout.input-div>

                <x-app-layout.input-div>
                    <x-app-layout-form.input input_type="text" name="divisional_leader" lablename="Divisional Leader/Overseer"
                        :value="old('divisional_leader', $division->divisional_leader)" />
                </x-app-layout.input-div>

                <div class="flex-shrink max-w-full px-4 w-full">
                    <x-app-layout-form.button> Update Division
                    </x-app-layout-form.button>

                    <x-app-layout-form.button-clear style="float: right" />

                </div>
            </form>


        </div>
    </div>
</x-app-layout>
