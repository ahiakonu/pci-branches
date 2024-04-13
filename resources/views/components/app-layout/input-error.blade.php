@props(['name'])
@error($name)
    <div class="text-red-600 text-sm" style="">{{ $message }}</div>
@enderror
