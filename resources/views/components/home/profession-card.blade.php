<div wire:key="{{ $professionId }}">
    <a wire:navigate href="{{ route('profession.questions', $professionId) }}"
       class="group p-4 md:p-5 gap-3 items-center flex flex-col md:flex-row justify-between bg-white border shadow-sm rounded-xl hover:shadow-md focus:outline-none focus:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800">
        <div class="flex items-center gap-3">
            <x-dynamic-component :component="$icon" :class="$iconColor . ' size-8'" />
            <div class="flex justify-between items-center gap-x-3">
                <div class="grow">
                    <h3 class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-neutral-400 dark:text-neutral-200">
                        {{ $profession }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-neutral-500">
                        Вопросов - {{ $count }}
                    </p>
                </div>
            </div>
        </div>
        <div>
            <x-mdi-chevron-right class="shrink-0 size-5 text-gray-800 dark:text-neutral-200" />
        </div>
    </a>
</div>
