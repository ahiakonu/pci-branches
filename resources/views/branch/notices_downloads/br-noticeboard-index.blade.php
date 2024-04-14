<x-app-layout>
    {{--  --}}
    <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
        <p class="text-xl font-bold mt-0 mb-5">Notice Board</p>
    </div>

    <div class="flex flex-wrap flex-row">
        <div class="flex-shrink max-w-full px-4 w-full lg:w-1/2 mb-6">{{-- lg:w-1/2 --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6">
                <div class="flex flex-row justify-between pb-6">
                    <div class="flex flex-col">
                        <h3 class="text-base font-bold">Leaderboard</h3>
                    </div>
                </div>
                <div class="relative">
                    <div class="overflow-x-auto">
                        <x-app-layout-table.table >
                            <x-app-layout-table.thead>
                                <x-app-layout-table.th lablename="Sender" />
                                <x-app-layout-table.th lablename="Message" />
                               <x-app-layout-table.th data-sortable="false" lablename="Actions" />
                            </x-app-layout-table.thead>
                            <x-app-layout-table.tbody>
                           

                            </x-app-layout-table.tbody>
                        </x-app-layout-table.table>


                        <table class="table-bordered-bottom table-sm w-full text-sm ltr:text-left rtl:text-right">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Users</th>
                                    <th>Progress</th>
                                    <th>Task</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="leading-5">#1</div>
                                    </td>
                                    <td>
                                        <div class="flex flex-wrap flex-row items-center">
                                            <div
                                                class="leading-5 font-bold text-gray-900 dark:text-gray-300 flex-shrink max-w-full w-full mb-1">
                                                John Thomas
                                            </div>
                                            <div class="leading-5 text-gray-500 flex-shrink max-w-full w-full">
                                                UI/UX
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <span class="ltr:mr-2 rtl:ml-2">78%</span>
                                            <div class="relative w-full">
                                                <div class="overflow-hidden h-2 text-xs flex rounded bg-green-300">
                                                    <div style="width:78%"
                                                        class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="leading-5">39/50</div>
                                    </td>
                                    <td class="px-3 py-4 whitespace-no-wrap text-center leading-5 font-medium">
                                        <a href="#"
                                            class="py-2 px-3 text-center mb-3 inline-block text-center mb-3 rounded leading-5 text-indigo-500 bg-transparent border border-indigo-500 hover:text-gray-100 hover:bg-indigo-600 hover:ring-0 hover:border-indigo-600 focus:text-gray-100 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="inline w-4 h-4 bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z">
                                                </path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="leading-5">#2</div>
                                    </td>
                                    <td>
                                        <div class="flex flex-wrap flex-row items-center">
                                            <div
                                                class="leading-5 font-bold text-gray-900 dark:text-gray-300 flex-shrink max-w-full w-full mb-1">
                                                Carlos Garcia
                                            </div>
                                            <div class="leading-5 text-gray-500 flex-shrink max-w-full w-full">
                                                Front End
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <span class="ltr:mr-2 rtl:ml-2">70%</span>
                                            <div class="relative w-full">
                                                <div class="overflow-hidden h-2 text-xs flex rounded bg-indigo-300">
                                                    <div style="width:70%"
                                                        class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="leading-5">35/50</div>
                                    </td>
                                    <td class="text-center">
                                        <a href="#"
                                            class="py-2 px-3 text-center mb-3 inline-block text-center mb-3 rounded leading-5 text-indigo-500 bg-transparent border border-indigo-500 hover:text-gray-100 hover:bg-indigo-600 hover:ring-0 hover:border-indigo-600 focus:text-gray-100 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="inline w-4 h-4 bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z">
                                                </path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="leading-5">#3</div>
                                    </td>
                                    <td>
                                        <div class="flex flex-wrap flex-row items-center">
                                            <div
                                                class="leading-5 font-bold text-gray-900 dark:text-gray-300 flex-shrink max-w-full w-full mb-1">
                                                Daniel Esteban
                                            </div>
                                            <div class="leading-5 text-gray-500 flex-shrink max-w-full w-full">
                                                Back End
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <span class="ltr:mr-2 rtl:ml-2">66%</span>
                                            <div class="relative w-full">
                                                <div class="overflow-hidden h-2 text-xs flex rounded bg-yellow-300">
                                                    <div style="width:66%"
                                                        class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-yellow-500">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="leading-5">33/50</div>
                                    </td>
                                    <td class="text-center">
                                        <a href="#"
                                            class="py-2 px-3 text-center mb-3 inline-block text-center mb-3 rounded leading-5 text-indigo-500 bg-transparent border border-indigo-500 hover:text-gray-100 hover:bg-indigo-600 hover:ring-0 hover:border-indigo-600 focus:text-gray-100 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="inline w-4 h-4 bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z">
                                                </path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="leading-5">#4</div>
                                    </td>
                                    <td>
                                        <div class="flex flex-wrap flex-row items-center">
                                            <div
                                                class="leading-5 font-bold text-gray-900 dark:text-gray-300 flex-shrink max-w-full w-full mb-1">
                                                Steven Rey
                                            </div>
                                            <div class="leading-5 text-gray-500 flex-shrink max-w-full w-full">
                                                Developer
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <span class="ltr:mr-2 rtl:ml-2">58%</span>
                                            <div class="relative w-full">
                                                <div class="overflow-hidden h-2 text-xs flex rounded bg-yellow-300">
                                                    <div style="width:58%"
                                                        class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-yellow-500">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="leading-5">29/50</div>
                                    </td>
                                    <td class="text-center">
                                        <a href="#"
                                            class="py-2 px-3 text-center mb-3 inline-block text-center mb-3 rounded leading-5 text-indigo-500 bg-transparent border border-indigo-500 hover:text-gray-100 hover:bg-indigo-600 hover:ring-0 hover:border-indigo-600 focus:text-gray-100 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="inline w-4 h-4 bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z">
                                                </path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="leading-5">#5</div>
                                    </td>
                                    <td>
                                        <div class="flex flex-wrap flex-row items-center">
                                            <div
                                                class="leading-5 font-bold text-gray-900 dark:text-gray-300 flex-shrink max-w-full w-full mb-1">
                                                Roman Davis
                                            </div>
                                            <div class="leading-5 text-gray-500 flex-shrink max-w-full w-full">
                                                UI/UX
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <span class="ltr:mr-2 rtl:ml-2">54%</span>
                                            <div class="relative w-full">
                                                <div class="overflow-hidden h-2 text-xs flex rounded bg-pink-300">
                                                    <div style="width:54%"
                                                        class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-pink-500">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="leading-5">27/50</div>
                                    </td>
                                    <td class="text-center">
                                        <a href="#"
                                            class="py-2 px-3 text-center mb-3 inline-block text-center mb-3 rounded leading-5 text-indigo-500 bg-transparent border border-indigo-500 hover:text-gray-100 hover:bg-indigo-600 hover:ring-0 hover:border-indigo-600 focus:text-gray-100 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="inline w-4 h-4 bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z">
                                                </path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="flex-shrink max-w-full px-4 w-full lg:w-1/2 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full p-6">
                <div class="flex flex-row justify-between pb-6">
                    <div class="flex flex-col">
                        <h3 class="text-base font-bold">Latest Project</h3>
                    </div>

                   {{--  <div class="flex flex-col">
                        <x-app-layout-form.input-select  name="search" lablename="Status" show_lable="false">
                            <option value="All"> All</option>
                            <option value="Read"> Read</option>
                            <option value="Unread"> Unread</option>
                        </x-app-layout-form.input-select>
                    </div> --}}
                </div>
                <div class="relative">
                    <div class="overflow-x-auto overflow-y-auto scrollbars show">
                        <div class="hidden-header hidden-sort-after">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{--  --}}
</x-app-layout>
