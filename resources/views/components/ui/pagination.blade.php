@props(['lastPage', 'currentPage','clickPage'])

<nav class="flex items-center gap-x-1">
    <button
        wire:click="{{$clickPage.'('.($currentPage - 1).')'}}"
        class="min-h-[32px] min-w-8 py-2 px-2 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100
               @if($currentPage === 1) pointer-events-none opacity-50 @endif
               dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
        @if($currentPage === 1) disabled @endif
    >
        <x-mdi-chevron-left />
        <span aria-hidden="true" class="sr-only">Previous</span>
    </button>

    <div class="flex items-center gap-x-1">
        <span class="min-h-[32px] min-w-8 flex justify-center items-center border border-gray-200 text-gray-800 py-1 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-white dark:focus:bg-neutral-800">
            {{ $currentPage }}
        </span>
        <span class="min-h-[32px] flex justify-center items-center text-gray-500 py-1.5 px-1.5 text-sm dark:text-neutral-500">из</span>
        <span class="min-h-[32px] flex justify-center items-center text-gray-500 py-1.5 px-1.5 text-sm dark:text-neutral-500">
            {{ $lastPage }}
        </span>
    </div>

    <button
        wire:click="{{$clickPage.'('.($currentPage + 1).')'}}"
        class="min-h-[32px] min-w-8 py-2 px-2 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100
               @if($currentPage === $lastPage) pointer-events-none opacity-50 @endif
               dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
        @if($currentPage === $lastPage) disabled @endif
    >
        <span aria-hidden="true" class="sr-only">Next</span>
        <x-mdi-chevron-right />
    </button>
</nav>
