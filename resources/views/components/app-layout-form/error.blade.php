@props(['name'])
@error($name)
    <div class="pristine-error text-help text-sm text-red-600" style="">{{ $message }}</div>
@enderror
