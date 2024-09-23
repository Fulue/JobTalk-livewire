<div>
    <div class="relative flex justify-center items-center size-12 bg-white rounded-xl before:absolute before:-inset-px before:-z-[1] before:bg-gradient-to-br before:from-blue-600 before:via-transparent before:to-violet-600 before:rounded-xl dark:bg-neutral-900">
        <x-dynamic-component :component="$icon" class="size-6 text-blue-600 dark:text-blue-500" />
    </div>
    <div class="mt-5">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $title }}</h3>
        <p class="mt-1 text-gray-600 dark:text-neutral-400">{{ $description }}</p>
    </div>
</div>
