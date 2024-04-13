<div class="row">
    @if (session()->has('success'))
        <div x-data="{ flash_open: true }" x-show="flash_open" x-init="setTimeout(() => flash_open = false, 6000)"
            class="flex justify-between items-center relative bg-green-100 text-green-900 py-3 px-6 rounded mb-4 text-sm">
            {{ session('success') }}
            <button type="button" @click="flash_open = false">
                <span class="text-2xl">×</span>
            </button>
        </div>
    @endif
</div>

<div class="row">
    @if (session()->has('errormessage'))
        <div x-data="{ flash_open: true }" x-show="flash_open" x-init="setTimeout(() => flash_open = false, 6000)"
            class="flex justify-between items-center relative bg-red-100 text-red-900 py-3 px-6 rounded mb-4 text-sm">
            {{ session('errormessage') }}
            <button type="button" @click="flash_open = false">
                <span class="text-2xl">×</span>
            </button>
        </div>
    @endif
</div>