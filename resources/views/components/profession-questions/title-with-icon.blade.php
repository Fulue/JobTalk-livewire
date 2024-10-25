<div class="flex items-center justify-between mb-10">
    <div>
        <x-dynamic-component :component="$icon" :class="$iconColor . ' size-14'" />
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">{{ $title }}</h2>
        <p class="mt-1 text-gray-600 dark:text-neutral-400">{{ $description }}</p>
    </div>

    <div class="flex justify-end rounded-lg mt-3 sm:mt-6 shadow-sm">
        <button
            wire:click="setTypeView(true)"
            type="button"
            class="p-3 inline-flex items-center gap-x-2 -ms-px first:rounded-s-lg first:ms-0 last:rounded-e-lg text-sm font-medium focus:z-10 border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
        >
            <x-mdi-view-headline class="size-6"/>
        </button>
        <button
            wire:click="setTypeView(false)"
            type="button"
            class="p-3 inline-flex items-center gap-x-2 -ms-px first:rounded-s-lg first:ms-0 last:rounded-e-lg text-sm font-medium focus:z-10 border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
        >
            <x-mdi-view-grid-outline class="size-6"/>
        </button>
    </div>
</div>
