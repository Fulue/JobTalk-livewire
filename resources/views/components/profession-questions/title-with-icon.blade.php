<div class="mb-10">
    <x-dynamic-component :component="$icon" :class="$iconColor . ' size-14'" />
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">{{ $title }}</h2>
    <p class="mt-1 text-gray-600 dark:text-neutral-400">{{ $description }}</p>
</div>
