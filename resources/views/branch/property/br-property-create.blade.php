<x-app-layout>
    <div class="flex-shrink max-w-full px-4 w-full mb-6">
        <div class="flex-shrink max-w-full px-4 w-full md:flex md:justify-between">
            <p class="text-xl font-bold mt-0 mb-5">Property Reporting</p>
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

            @php
                
                $prop = $branch->property;
                
                if ($prop == null) {
                    $prop = (object) [
                        'pastor_name' => '',
                        'meeting_place' => '',
                        'own_land' => '',
                        'other_lands' => '',
                        'available_doc' => '',
                        'registration_stage' => '',
                        'document_location' => '',
                        'remarks' => '',
                        'photo1' => '',
                        'photo2' => '',
                    ];
                }
            @endphp

            <form class="flex flex-wrap flex-row -mx-4" method="POST" action="{{ route('propertyreport.store') }}"
                onsubmit="return SubmitFromAlert(this,' Save property report');" enctype="multipart/form-data">
                @csrf

                {{--  Create/Update Property:: --}}
                <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                <x-app-layout.input-div margin="mb-1 ">
                    <p class="text-indigo-600 ">
                        <x-app-svg.layout />
                        Create/Update Property::
                    </p>
                </x-app-layout.input-div>
                <x-app-layout-form.gray-div>
                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="text" name="church_name" lablename="Church Name"
                            class="bg-gray-50" value="{{ $branch->church_name }}" disabled />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="text" name="church_division" lablename="Division "
                            class="bg-gray-50" value="{{ $branch->division->division_name }}" disabled />
                    </x-app-layout.input-div>


                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="text" name="pastor_name" lablename="Pastor Name *"
                            :value="old('pastor_name', $prop->pastor_name)" />
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/2 ">
                        <x-app-layout-form.input input_type="text" name="meeting_place" lablename="Location *"
                            :value="old('meeting_place', $prop->meeting_place)" />
                    </x-app-layout.input-div>


                    <x-app-layout-form.input-select class=" md:w-1/3 " name="own_land" lablename="Own Church Land *">
                        @foreach ($yesno as $yn)
                            @if (old('own_land', $prop->own_land) == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.input input_type="text" name="other_lands" lablename="Other lands"
                            :value="old('other_lands', $prop->other_lands)" input_required="false" />
                    </x-app-layout.input-div>



                    <x-app-layout-form.input-select class=" md:w-1/3 " name="available_doc"
                        lablename="Available Document *">
                        @foreach ($landdoc as $yn)
                            @if (old('available_doc', $prop->available_doc) == $yn)
                                <option value="{{ $yn }}" selected> {{ $yn }}
                                </option>
                            @else
                                <option value="{{ $yn }}"> {{ $yn }}
                                </option>
                            @endif
                        @endforeach
                    </x-app-layout-form.input-select>

                    <x-app-layout.input-div>
                        <x-app-layout-form.textarea name="registration_stage"
                            lablename="Stage of Registration Process *">
                            {{ old('registration_stage', $prop->registration_stage) }}
                        </x-app-layout-form.textarea>
                    </x-app-layout.input-div>

                    <x-app-layout.input-div>
                        <x-app-layout-form.textarea name="document_location" lablename="Location of Documents *">
                            {{ old('document_location', $prop->document_location) }} </x-app-layout-form.textarea>
                    </x-app-layout.input-div>

                    <x-app-layout.input-div>
                        <x-app-layout-form.textarea name="remarks" lablename="Remarks" input_required="false">
                            {{ old('remarks', $prop->remarks) }}</x-app-layout-form.textarea>
                    </x-app-layout.input-div>

                    <input type="hidden" name="imagepath1" value="{{ $prop->photo1 }}">
                    <input type="hidden" name="imagepath2" value="{{ $prop->photo2 }}">
                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.label name="image1" lablename="Property Photo 1" />
                        <input
                            class="w-full leading-5 relative py-2 px-4 p-10 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600"
                            type="file" accept="png,jpg,jpeg" name="image1">
                        <x-app-layout-form.error name="file"></x-app-layout-form.error>
                    </x-app-layout.input-div>

                    <x-app-layout.input-div class=" md:w-1/3 ">
                        <x-app-layout-form.label name="image1" lablename="Property Photo 2" />
                        <input
                            class="w-full leading-5 relative py-2 px-4 p-10 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600"
                            type="file" accept="png,jpg,jpeg" name="image2">
                        <x-app-layout-form.error name="file"></x-app-layout-form.error>
                    </x-app-layout.input-div>

                    {{--  --}}
                    <x-app-layout.input-div class=" md:w-1/3 ">
                        @if ($prop->photo1 != null)
                            <ul class="py-4 ltr:text-left rtl:text-right">
                                <li class="inline-block">
                                    <a href="{{ asset($prop->photo1) }}" class="glightbox3"
                                        data-gallery="gallery1"><img src="{{ asset($prop->photo1) }}"
                                            class="w-20 h-20 ltr:mr-1 rtl:ml-1 border border-dashed rounded-full"></a>
                                </li>
                                @if ($prop->photo2 != null)
                                    <li class="inline-block">
                                        <a href="{{ asset($prop->photo2) }}" class="glightbox3"
                                            data-gallery="gallery1"><img src="{{ asset($prop->photo2) }}"
                                                class="w-20 h-20 ltr:mr-1 rtl:ml-1 border border-dashed rounded-full"></a>
                                    </li>
                                @endif

                            </ul>
                        @endif

                    </x-app-layout.input-div>
                    {{--  --}}
                </x-app-layout-form.gray-div>
                {{--  //Create/Update Property:: --}}




                <div class="flex-shrink max-w-full px-4 w-full">
                    <x-app-layout-form.button> Save Property Report
                    </x-app-layout-form.button>

                    <x-app-layout-form.button-clear style="float: right" />

                </div>
            </form>
        </div>
    </div>
</x-app-layout>

@include('components.app-layout-form.ajax-branch');
