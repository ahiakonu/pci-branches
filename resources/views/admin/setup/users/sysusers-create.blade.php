<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between my-3">
            <p class="text-xl font-bold mt-0 mb-5">Create New User</p>

            <x-app-layout.back-button href="{{ route('users.index') }}" />

        </div>


        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">

            <div class="md:flex md:justify-between">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300 ">New User</h2>
            </div>



            <hr class="mb-4 ">

            <x-app-layout.flash />
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form class="flex flex-wrap flex-row -mx-4" method="POST" action="{{ route('users.store') }}"
                onsubmit="return SubmitFromAlert(this,' Create new user');">
                @csrf

                <x-app-layout-form.input-select class=" md:w-1/3 " name="user_role" lablename="User Type *">
                    @foreach ($roles as $role)
                        @if (old('user_role') == $role)
                            <option value="{{ $role }}" selected> {{ str_replace('_', ' ', $role) }}
                            </option>
                        @else
                            <option value="{{ $role }}"> {{ $role }}
                            </option>
                        @endif
                    @endforeach
                </x-app-layout-form.input-select>

                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="email" lablename="User ID (email) *"
                        placeholder="login email" :value="old('email')" />
                </x-app-layout.input-div>

                <x-app-layout.input-div class=" md:w-1/3 ">
                    <x-app-layout-form.input input_type="text" name="name" lablename="Name *" :value="old('name')" />
                </x-app-layout.input-div>



                <x-app-layout-form.select class=" md:w-1/3 " name="division_id" lablename="PCI Divisions *"
                    :selectdata="$divisionsCombo" required="" />

                <input type="text" hidden id="old_zone" value="{{ old('zone_id') }}" class="full-width">
                <x-app-layout-form.input-select class=" md:w-1/3 " name="zone_id" lablename="Division Zone *"
                    required="" />




                <div class="flex-shrink max-w-full px-4 w-full">
                    <x-app-layout-form.button> Create New User
                    </x-app-layout-form.button>

                    <x-app-layout-form.button-clear style="float: right" />

                </div>
            </form>
        </div>
    </div>
</x-app-layout>

@include('components.app-layout-form.ajax-branch');
