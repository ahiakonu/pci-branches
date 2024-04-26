<nav id="sidebar-menu" x-description="Mobile menu" x-bind:aria-expanded="open"
    :class="{ 'w-64 md:w-0': open, 'w-0 md:w-64': !(open) }"
    class="fixed w-64 transition-all duration-500 ease-in-out h-screen bg-white dark:bg-gray-800 shadow-sm">
    <div class="h-full overflow-y-auto scrollbars">
        <!--logo-->
        <div class="mh-18 text-center py-5">
            <a href="/" class="relative">
                <h2 class="text-2xl font-semibold text-gray-200 px-4 max-h-9 overflow-hidden hidden-compact">
                    <!--<img class="inline-block w-7 h-auto ltr:mr-2 rtl:ml-2 -mt-1" src="/src/img/logo.png"> -->
                    <img src="{{ asset('tdash/src/img/pci_logo.png') }}"
                        class="inline-block w-7 h-auto ltr:mr-2 rtl:ml-2 -mt-1">

                    <span class="text-gray-700 dark:text-gray-200">PCI Reporting</span>
                </h2>
                <h2 class="text-3xl font-semibold mx-auto logo-compact hidden">
                    <!-- <img class="inline-block w-7 h-auto -mt-1" src="/src/img/logo.png"> -->
                    <img src="{{ asset('tdash/src/img/pci_logo.png') }}" class="inline-block w-7 h-auto -mt-1">
                </h2>
            </a>
        </div>
        
        @can('divisional')
            @php
                $url = '/' . Route::current()->uri;
                $selected = 0;
                if (str_contains($url, '/divisional/dashboard')) {
                    $selected = 1;
                } elseif (str_contains($url, '/divisional/zone/reports') || str_contains($url, '/divisional/branch/reports') || str_contains($url, '/divisional/divisional')) {
                    $selected = 2;
                } elseif (str_contains($url, '/zonal/noticedownload/downloads')) {
                    $selected = 3;
                }
            @endphp
        @endcan
        @can('zonal')
            @php
                $url = '/' . Route::current()->uri;
                $selected = 0;
                if (str_contains($url, '/zonal/dashboard')) {
                    $selected = 1;
                } elseif (str_contains($url, '/zonal/zone/') || str_contains($url, '/zonal/branch/reports') || str_contains($url, '/zonal/branch/reports/show')) {
                    $selected = 2;
                } elseif (str_contains($url, '/zonal/noticedownload/downloads')) {
                    $selected = 3;
                }
            @endphp
        @endcan
        @can('branch')
            @php
                $url = '/' . Route::current()->uri;
                $selected = 0;
                if (str_contains($url, '/branchdashboard')) {
                    $selected = 1;
                } elseif (str_contains($url, '/branchreport') || str_contains($url, '/propertyreport')) {
                    $selected = 2;
                } elseif (str_contains($url, '/noticedownload')) {
                    $selected = 3;
                }
            @endphp
        @endcan
        @can('admin')
            @php
                $url = '/' . Route::current()->uri;
                $selected = 0;
                if (str_contains($url, '/dashboard')) {
                    $selected = 1;
                } elseif (str_contains($url, '/admin/reports/') || str_contains($url, '/propertyreport')) {
                    $selected = 2;
                } elseif (str_contains($url, '/admin/setup/')) {
                    $selected = 3;
                }
            @endphp
        @endcan



        <!-- Sidebar menu -->
        <ul id="side-menu" x-data="{ selected: {{ $selected }} }"
            class="w-full float-none flex flex-col font-medium ltr:pl-1.5 rtl:pr-1.5">
            <!-- ADMIN MENUS -->
            @can('admin')
                <x-app-layout.sm-li lable="Dashboard" link="/dashboard">
                    <x-app-svg.dashboard />
                </x-app-layout.sm-li>
                <x-app-layout.sm-lidropdown sel_index="2" sgv="Utilities" lable="Report Analysis">
                    <x-app-layout.sm-ul-li lable="Branch Reports" link="/admin/reports/branchreports" />
                    <x-app-layout.sm-ul-li lable="Attendance Reports" link="/admin/reports/attendance" />
                    <x-app-layout.sm-ul-li lable="Financial Report" link="/admin/reports/finance" />
                    <x-app-layout.sm-ul-li lable="Branches Info Report" link="/admin/reports/branches" />
                    <x-app-layout.sm-ul-li lable="Branch Properties" link="/admin/reports/branchproperty" />
                    <x-app-layout.sm-ul-li lable="Financial Report" link="/admin/reports/finance" />
                    <x-app-layout.sm-ul-li lable="Cell Report" link="/admin/reports/lfu" />
                    <x-app-layout.sm-ul-li lable="Zonal Report" link="/admin/reports/zonalreports" />
                </x-app-layout.sm-lidropdown>
                <x-app-layout.sm-lidropdown sel_index="3" sgv="Utilities" lable="System Settings">
                    <x-app-layout.sm-ul-li lable="Document Uploads" link="/admin/setup/upload" />
                    <x-app-layout.sm-ul-li lable="Branches" link="/admin/setup/branches" />
                    <x-app-layout.sm-ul-li lable="Divisions" link="/admin/setup/divisions" />
                    <x-app-layout.sm-ul-li lable="Zones" link="/admin/setup/zones" />
                    <x-app-layout.sm-ul-li lable="System Users" link="/admin/setup/users" />
                </x-app-layout.sm-lidropdown>
            @endcan
            <!-- //ADMIN MENUS -->

            <!-- BRANCH MENUS -->
            @can('branch')
                <x-app-layout.sm-li lable="Dashboard" link="/branchdashboard">
                    <x-app-svg.dashboard />
                </x-app-layout.sm-li>

                <x-app-layout.sm-lidropdown sel_index="2" sgv="Utilities" lable="Branch Reporting">
                    <x-app-layout.sm-ul-li lable="Branch Report" link="/branch/branchreport/" />
                    {{-- <x-app-layout.sm-ul-li lable="Report History" link="/branch/branchreport/history" /> --}}
                    <x-app-layout.sm-ul-li lable="Property Report" link="/branch/propertyreport" />
                </x-app-layout.sm-lidropdown>

                <x-app-layout.sm-lidropdown sel_index="3" sgv="Utilities" lable="Notices & Downloads">
                    <x-app-layout.sm-ul-li lable="Notice Board" link="{{ route('noticeboard.noticeBoard') }}" />
                    <x-app-layout.sm-ul-li lable="Admin Downloads" link="{{ route('noticeboard.documentDownloads') }}" />
                </x-app-layout.sm-lidropdown>
            @endcan
            <!-- //BRANCH MENUS -->

            <!-- ZONAL MENUS -->
            @can('zonal')
                <x-app-layout.sm-li lable="Dashboard" link="/zonal/dashboard">
                    <x-app-svg.dashboard />
                </x-app-layout.sm-li>

                <x-app-layout.sm-lidropdown sel_index="2" sgv="Utilities" lable="Reporting">
                    <x-app-layout.sm-ul-li lable="Zonal Report" link="/zonal/zone/index" />
                    <x-app-layout.sm-ul-li lable="Branch Report - Summary"
                        link="/zonal/branch/reports?year={{ now()->year }}&month={{ now()->month }}" />
                    <x-app-layout.sm-ul-li lable="Branch Report - Details" link="/zonal/branch/reports/show" />

                </x-app-layout.sm-lidropdown>

                <x-app-layout.sm-lidropdown sel_index="3" sgv="Utilities" lable="Notices & Downloads">
                    {{-- <x-app-layout.sm-ul-li lable="Notice Board" link="{{ route('noticeboard.noticeBoard') }}" /> --}}
                    <x-app-layout.sm-ul-li lable="Admin Downloads"
                        link="/zonal/noticedownload/downloads" />
                </x-app-layout.sm-lidropdown>
            @endcan
            <!-- //ZONAL MENUS -->

            <!-- DIVISIONAL MENUS -->
            @can('divisional')
                <x-app-layout.sm-li lable="Dashboard" link="/divisional/dashboard">
                    <x-app-svg.dashboard />
                </x-app-layout.sm-li>

                <x-app-layout.sm-lidropdown sel_index="2" sgv="Utilities" lable="Reporting">
                    <x-app-layout.sm-ul-li lable="Divisional Report" link="/divisional/divisional/index" />
                    <x-app-layout.sm-ul-li lable="Zonal Reports" link="/divisional/zone/reports" /> 
                    <x-app-layout.sm-ul-li lable="Branch Report - Details" link="/divisional/branch/reports" />

                </x-app-layout.sm-lidropdown>

                <x-app-layout.sm-lidropdown sel_index="3" sgv="Utilities" lable="Notices & Downloads"> 
                    <x-app-layout.sm-ul-li lable="Admin Downloads"
                        link="/divisional/noticedownload/downloads" />
                </x-app-layout.sm-lidropdown>
            @endcan
            <!-- //DIVISIONAL MENUS -->





        </ul>


    </div>
</nav>
