@props(['division_id'=>'','selectdata'])
<select name="division_id" id="division_id"
    {{ $attributes([
        'class' => 'inline-block w-full leading-5 relative py-2 pl-3 pr-8 rounded text-gray-800 bg-white border
                            border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 dark:text-gray-300
                            dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600 select-caret appearance-none',
    ]) }}>

    <option value="">Select PCI Division</option>

    @foreach ($selectdata as $item)
        @if (old('division_id', $division_id) == $item->id)
            <option value="{{ $item->id }}" selected> {{ $item->division_name }} </option>
        @else
            <option value="{{ $item->id }}"> {{ $item->division_name }} </option>
        @endif
    @endforeach

</select>