<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6 my-3">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Reports Analysis</p>

            <x-app-layout.back-button href="/branch/branchreport" />

        </div>

            {{-- row 3 --}}
    <div class="flex flex-wrap flex-row">
        <div class="flex-shrink max-w-full px-4 w-full  mb-6">
            <!-- visitor -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg mb-6">
                <div class="flex flex-row justify-between pb-6">
                    <div class="flex flex-col">
                        <h3 class="text-base font-bold">Monthly Sales</h3>
                        <span class="text-gray-500 text-sm">Monthly Traffic and Sales</span>
                    </div>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = ! open"
                            class="text-gray-500 hover:text-gray-600 dark:hover:text-gray-400 transition-colors duration-200 focus:outline-none hover:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 bi bi-three-dots"
                                viewBox="0 0 16 16">
                                <path
                                    d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z">
                                </path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="origin-top-right absolute ltr:right-0 rtl:left-0 rounded rounded-t-non bg-white dark:bg-gray-800 z-10 rounded border border-gray-200 dark:border-gray-700"
                            style="min-width: 12rem; display: none;">
                            <a class="block px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:focus:bg-gray-900"
                                href="#">Daily</a>
                            <a class="block px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:focus:bg-gray-900"
                                href="#">Weekly</a>
                            <a class="block px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:focus:bg-gray-900"
                                href="#">Yearly</a>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <canvas class="max-w-100" id="BarChart"
                        style="display: block; box-sizing: border-box; height: 312px; width: 624px;" width="1248"
                        height="624"></canvas>
                </div>
            </div>

            <!-- Paid ads -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <div class="relative">
                    <table class="table-sm text-sm ltr:text-left rtl:text-right w-full">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th>
                                    Platform
                                </th>
                                <th>
                                    Visitors
                                </th>
                                <th>
                                    Ads budget
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Facebook Ads
                                </td>
                                <td>
                                    1,520
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="ltr:mr-2 rtl:ml-2">78%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-indigo-300">
                                                <div style="width:78%"
                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Google Ads
                                </td>
                                <td>
                                    980
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="ltr:mr-2 rtl:ml-2">65%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-pink-300">
                                                <div style="width:65%"
                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-pink-500">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Microsoft Ads
                                </td>
                                <td>
                                    540
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="ltr:mr-2 rtl:ml-2">55%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-yellow-300">
                                                <div style="width:55%"
                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-yellow-500">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tiktok Ads
                                </td>
                                <td>
                                    350
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <span class="ltr:mr-2 rtl:ml-2">40%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-400">
                                                <div style="width:40%"
                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gray-700">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="flex-shrink max-w-full px-4 w-full lg:w-1/2 mb-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-row justify-between pb-6">
                    <div class="flex flex-col">
                        <h3 class="text-base font-bold">Traffic Source</h3>
                        <span class="text-gray-500 text-sm">Monthly traffic source</span>
                    </div>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = ! open"
                            class="text-gray-500 hover:text-gray-600 dark:hover:text-gray-400 transition-colors duration-200 focus:outline-none hover:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="w-6 h-6 bi bi-three-dots" viewBox="0 0 16 16">
                                <path
                                    d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z">
                                </path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="origin-top-right absolute ltr:right-0 rtl:left-0 rounded rounded-t-non bg-white dark:bg-gray-800 z-10 rounded border border-gray-200 dark:border-gray-700"
                            style="min-width: 12rem; display: none;">
                            <a class="block px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:focus:bg-gray-900"
                                href="#">Daily</a>
                            <a class="block px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:focus:bg-gray-900"
                                href="#">Weekly</a>
                            <a class="block px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:focus:bg-gray-900"
                                href="#">Yearly</a>
                        </div>
                    </div>
                </div>
                <div class="relative mx-auto text-center w-full sm:w-2/3 lg:w-full">
                    <canvas class="max-w-100" id="DoughnutChart"
                        style="display: block; box-sizing: border-box; height: 624px; width: 624px;" width="1248"
                        height="1248"></canvas>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
