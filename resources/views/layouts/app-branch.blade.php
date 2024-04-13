<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Title  -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Perez Chapel International - PCI, Branch Reporting">

    <!-- Development css (used in all pages) -->
    <link rel="stylesheet" id="stylesheet" href="{{ asset('tdash/src/css/style.css') }}">
    <!-- Production css (used in all pages) -->
    <!-- <link rel="stylesheet" href="../dist/css/style.css"> -->

    <!--start::Vendor Stylesheets (only on this page)-->
    <link rel="stylesheet" href="{{ asset('tdash/src/css/customizer.css') }}">
    <link rel="stylesheet" href="{{ asset('tdash/src/css/prism.css') }}">
    <!--end::Vendor Stylesheets (only on this page)-->

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&amp;display=swap" rel="stylesheet">



    <!-- Favicon  -->
    {{--  <link rel="icon" href="/src/img/favicon.png"> --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('tdash/src/img/pci_logo.png') }}" />

</head>

<body class="font-sans text-base font-normal text-gray-600 dark:text-gray-400 dark:bg-gray-800">
    <!-- wrapper -->
    <div x-data="{ open: false }" class="wrapper overflow-x-hidden bg-gray-100 dark:bg-gray-900 dark:bg-opacity-40">

        @include('components.app-layout._nav-sidemenu')

        <div x-bind:aria-expanded="open"
            :class="{
                'ltr:ml-64 ltr:-mr-64 md:ltr:ml-0 md:ltr:mr-0 rtl:mr-64 rtl:-ml-64 md:rtl:mr-0 md:rtl:ml-0': open,
                'ltr:ml-0 ltr:mr-0 md:ltr:ml-64 rtl:mr-0 rtl:ml-0 md:rtl:mr-64':
                    !(open)
            }"
            class="flex flex-col ltr:ml-64 rtl:mr-64 min-h-screen transition-all duration-500 ease-in-out">

            <!-- Navbar -->
            @include('components.app-layout._nav-header')
            <!-- End Navbar -->

            <main class="pt-20 -mt-2">
                <div class="mx-auto p-2">

                    {{ $slot }}

                </div>
            </main>

            {{-- footer --}}
            @include('components.app-layout._footer')
        </div>
    </div>

    <!--start::Global javascript (used in all pages)-->
    <script src="{{ asset('tdash/vendors/alpinejs/dist/cdn.min.js') }}"></script><!-- core js -->
    <script src="{{ asset('tdash/vendors/chart.js/dist/chart.min.js') }}"></script><!-- charts -->
    <script src="{{ asset('tdash/vendors/flatpickr/dist/flatpickr.min.js') }}"></script><!-- input date -->
    <script src="{{ asset('tdash/vendors/flatpickr/dist/plugins/rangePlugin.js') }}"></script><!-- input range date -->
    <script src="{{ asset('tdash/vendors/@yaireo/tagify/dist/tagify.min.js') }}"></script><!-- input tags -->
    <script src="{{ asset('tdash/vendors/pristinejs/dist/pristine.min.js') }}"></script><!-- form validation -->
    <script src="{{ asset('tdash/vendors/simple-datatables/dist/umd/simple-datatables.js') }}"></script>
    <!--sort table-->
    <script src="{{ asset('tdash/vendors/glightbox/dist/js/glightbox.min.js') }}"></script><!-- lightbox image -->
    <script src="{{ asset('tdash/vendors/flickity/dist/flickity.pkgd.min.js') }}"></script><!-- slider -->
    <!--end::Global javascript (used in all pages)-->

    <script src="{{ asset('tdash/vendors/sweetalert2/dist/sweetalert2.min.js') }}"></script><!-- sweet alert -->
    <!-- Minify Global javascript (for production purpose) -->
    <!-- <script src="../dist/js/scripts.js') }}"></script> -->

    <!--start::Demo javascript ( initialize global javascript )-->
    <script src="{{ asset('tdash/src/js/demo.js') }}"></script>

    <!--start::Customizer js ( Only for demo purpose )-->
    <script src="{{ asset('tdash/src/js/customizer.js') }}"></script>

    <!--my sweet alert codes--->
    <script src="{{ asset('tdash/src/js/mysweet-alert.js') }}"></script>

    {{-- Google Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>

</html>
