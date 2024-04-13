<x-app-layout>
    <div class="flex flex-wrap flex-row">
        <div class="flex-shrink max-w-full px-4 w-full my-3">
            <p class="text-xl font-bold mt-0 mb-5 ">System Users</p>
        </div>

        <div class="flex-shrink max-w-full px-4 w-full mb-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-wrap flex-row -mx-4">
                    <div class="flex-shrink max-w-full px-4 w-full">
                        <div class="md:flex md:justify-between">
                            <x-app-layout-form.add-button href="{{ route('users.create') }}">Add Users
                            </x-app-layout-form.add-button>
                        </div>
                        <x-app-layout.flash />


                        <x-app-layout-table.table class="hidden-header hidden-sort-after">
                            <x-app-layout-table.thead>
                                <x-app-layout-table.th lablename="User Name" />
                                <x-app-layout-table.th lablename="User ID" />
                                <x-app-layout-table.th lablename="User Type" />
                                <x-app-layout-table.th lablename="User Status" />
                                <x-app-layout-table.th data-sortable="false" lablename="Actions" />
                            </x-app-layout-table.thead>
                            <x-app-layout-table.tbody>
                                @foreach ($users as $user)
                                    <tr>

                                        <x-app-layout-table.td>{{ $user->name }}</x-app-layout-table.td>
                                        <x-app-layout-table.td> {{ $user->email }} </x-app-layout-table.td>
                                        <x-app-layout-table.td> {{ $user->user_role }} </x-app-layout-table.td>
                                        <x-app-layout-table.td>
                                            @if ($user->user_status === 'Active')
                                                <x-app-layout-table.tt-green>
                                                    {{ $user->user_status }}
                                                </x-app-layout-table.tt-green>
                                            @elseif ($user->user_status === 'New')
                                                <x-app-layout-table.tt-yellow>
                                                    {{ $user->user_status }}
                                                </x-app-layout-table.tt-yellow>
                                            @else
                                                <x-app-layout-table.tt-red>
                                                    {{ $user->user_status }}
                                                </x-app-layout-table.tt-red>
                                            @endif
                                        </x-app-layout-table.td>

                                        <x-app-layout-table.td>
                                            <div class="flex">
                                                @if ($user->id != 1)
                                                    <form action="{{ route('users.destroy', $user->id) }}"
                                                        method="post"
                                                        onsubmit="return SubmitDelete(this,'Delete {{ $user->name }}');">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="inline-block ltr:mr-2 rtl:ml-2 hover:text-red-500">
                                                            <x-app-svg.delete />
                                                        </button>
                                                    </form>
                                                @endif
                                              
                                                <x-app-layout.tooltip-header>
                                                    <a href="javascript:;" x-on:mouseover="tooltips = true"
                                                        x-on:mouseleave="tooltips = false"
                                                        onclick="SumitEdit('Edit {{ $user->name }} ?','/admin/setup/users/{{ $user->id }}/edit')"
                                                        class="inline-block ltr:mr-2 rtl:ml-2 hover:text-green-500">
                                                        <x-app-svg.edit />
                                                        <x-app-layout.tooltip-details tooltip_label="Edit" />
                                                    </a>
                                                </x-app-layout.tooltip-header>

                                                <form action="{{ route('admin.users.resetpassword', $user->id) }}"
                                                    method="post"
                                                    onsubmit="return SubmitDelete(this,'Reset password - {{ $user->name }} ');">
                                                    @csrf
                                                    @method('patch')
                                                    <x-app-layout.tooltip-header>
                                                        <button type="submit" x-on:mouseover="tooltips = true"
                                                            x-on:mouseleave="tooltips = false"
                                                            class="inline-block ltr:mr-2 rtl:ml-2 hover:text-yellow-500">
                                                            <x-app-svg.lockfile />
                                                            <x-app-layout.tooltip-details
                                                                tooltip_label="Reset Password" />
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
            </div>
        </div>
    </div>

</x-app-layout>

<script></script>
