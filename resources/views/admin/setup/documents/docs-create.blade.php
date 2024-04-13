<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">New Document Upload</p>

            <x-app-layout.back-button href="{{ route('upload.index') }}" />
        </div>




        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
            <x-app-layout.flash />
            @if ($errors->any())
                <div x-data="{ open: true }" x-show="open"
                    class="flex justify-between items-center relative bg-red-100 text-red-900 py-3 px-6 rounded mb-4">

                    <div class="pristine-error text-help text-sm text-red-600">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <button type="button" @click="open = false">
                        <span class="text-2xl">×</span>
                    </button>
                </div>
            @endif



            <form class="flex flex-wrap flex-row -mx-4" method="POST" action="{{ route('upload.store') }}"
                onsubmit="return SubmitFromAlert(this,' Save Document');" enctype="multipart/form-data">
                @csrf

                <x-app-layout-form.gray-div>
                    
                    <x-app-layout.input-div class=" ">
                        <x-app-layout-form.input input_type="text" name="title" lablename="Document Title *"
                            :value="old('title')" />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" ">
                        <p class="text-lg font-bold">
                            <x-app-svg.upload></x-app-svg.upload> Upload pdf file
                        </p>
                        <div class="mb-6">
                            <x-app-layout-form.upload-pdf ></x-app-layout-form.upload-pdf>
                        </div>
                    </x-app-layout.input-div>


                </x-app-layout-form.gray-div>
                <div class="flex-shrink max-w-full px-4 w-full">
                    <x-app-layout-form.button> Save PDF Document
                    </x-app-layout-form.button>

                    <x-app-layout-form.button-clear style="float: right" />

                </div>
            </form>
        </div>
    </div>
</x-app-layout>

{{-- @include('components.app-layout-form.ajax-branch'); --}}
