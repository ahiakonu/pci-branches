<x-app-layout>
    <div class="flex flex-wrap flex-row">
        <div class="flex-shrink max-w-full px-4 w-full">
            <p class="text-xl font-bold mt-0 mb-5">Branches</p>
        </div>

        <div class="flex-shrink max-w-full px-4 w-full mb-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-wrap flex-row -mx-4">
                    <div class="flex-shrink max-w-full px-4 w-full">
                        <div class="md:flex md:justify-between">
                            <x-app-layout-form.add-button href="{{ route('branches.create') }}">Add Branch
                            </x-app-layout-form.add-button>



                        </div>
                        <x-app-layout.flash />

                        <x-app-layout-table.table class="hidden-header hidden-sort-after">
                            <x-app-layout-table.thead>
                                <x-app-layout-table.th lablename="Church Name" />
                                <x-app-layout-table.th lablename="Location" />
                                <x-app-layout-table.th lablename="Division" />
                                <x-app-layout-table.th lablename="Zone" class="hidden lg:table-cell" />
                                <x-app-layout-table.th lablename="Email" />
                                <x-app-layout-table.th lablename="Currency" />
                                <x-app-layout-table.th lablename="Login_Status" />
                                <x-app-layout-table.th lablename="Country" />
                                <x-app-layout-table.th lablename="Status" class="hidden lg:table-cell" />
                                <x-app-layout-table.th lablename="Church_Target(Attd&Inc)" />
                                <x-app-layout-table.th data-sortable="false" lablename="Actions" />
                            </x-app-layout-table.thead>
                            <x-app-layout-table.tbody>
                                @foreach ($branches as $branch)
                                    <tr>
                                        <x-app-layout-table.td> {{ $branch->church_name }} </x-app-layout-table.td>
                                        <x-app-layout-table.td> {{ $branch->church_location }} </x-app-layout-table.td>
                                        <x-app-layout-table.td> {{ $branch->division->division_name }}
                                        </x-app-layout-table.td>
                                        <x-app-layout-table.td class="hidden lg:table-cell">
                                            {{ $branch->zone->zone_name }} </x-app-layout-table.td>
                                        <x-app-layout-table.td>{{ $branch->church_email }}</x-app-layout-table.td>
                                        <x-app-layout-table.td>{{ $branch->currency }}</x-app-layout-table.td>
                                        <x-app-layout-table.td>
                                            @if ($branch->user->user_status === 'Active')
                                                <x-app-layout-table.tt-green>
                                                    {{ $branch->user->user_status }}
                                                </x-app-layout-table.tt-green>
                                            @elseif ($branch->user->user_status === 'New')
                                                <x-app-layout-table.tt-yellow>
                                                    {{ $branch->user->user_status }}
                                                </x-app-layout-table.tt-yellow>
                                            @else
                                                <x-app-layout-table.tt-red>
                                                    {{ $branch->user->user_status }}
                                                </x-app-layout-table.tt-red>
                                            @endif

                                        </x-app-layout-table.td>
                                        <x-app-layout-table.td>{{ $branch->division->country }}</x-app-layout-table.td>
                                        <x-app-layout-table.td class="hidden lg:table-cell">

                                            @if ($branch->church_status === 'Active')
                                                <x-app-layout-table.tt-green>
                                                    {{ $branch->church_status }}
                                                </x-app-layout-table.tt-green>
                                            @else
                                                <x-app-layout-table.tt-red>
                                                    {{ $branch->church_status }}
                                                </x-app-layout-table.tt-red>
                                            @endif

                                        </x-app-layout-table.td>
                                        <x-app-layout-table.td>
                                            @if (count($branch->targets) > 0)
                                                Income : <span
                                                    class="text-sm text-red-400">{{ $branch->currency }}</span>@fmoney($branch->targets[0]->income) ,
                                                Attendance : {{ $branch->targets[0]->attendance }}
                                            @endif

                                            {{--  @isset($branch->targets . length)
                                            {{$branch->targets}}
                                           
                                            @endisset --}}

                                        </x-app-layout-table.td>
                                        <x-app-layout-table.td>
                                            <div class="flex">

                                                <form action="{{ route('branches.destroy', $branch->id) }}"
                                                    method="post"
                                                    onsubmit="return SubmitDelete(this,'Delete {{ $branch->church_name }}');">
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

                                                <x-app-layout.tooltip-header>
                                                    <a href="javascript:;" x-on:mouseover="tooltips = true"
                                                        x-on:mouseleave="tooltips = false"
                                                        onclick="SumitEdit('Edit {{ $branch->church_name }} ?','/admin/setup/branches/{{ $branch->id }}/edit')"
                                                        class="inline-block ltr:mr-2 rtl:ml-2 hover:text-green-500">
                                                        <x-app-svg.edit />
                                                        <x-app-layout.tooltip-details tooltip_label="Edit" />
                                                    </a>
                                                </x-app-layout.tooltip-header>

                                                <x-app-layout.tooltip-header>
                                                    <a x-on:mouseover="tooltips = true"
                                                        x-on:mouseleave="tooltips = false"
                                                        href="{{route('admin.branch.showTargets',$branch->id )}}"
                                                        class="inline-block ltr:mr-2 rtl:ml-2 hover:text-green-500">
                                                        <x-app-svg.target />
                                                        <x-app-layout.tooltip-details tooltip_label="Target" />
                                                    </a>
                                                </x-app-layout.tooltip-header>


                                                <form action="{{ route('admin.branch.resetpassword', $branch->id) }}"
                                                    method="post"
                                                    onsubmit="return SubmitDelete(this,'Reset password - {{ $branch->church_name }} ');">
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
