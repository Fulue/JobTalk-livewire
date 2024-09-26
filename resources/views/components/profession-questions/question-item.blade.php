<a
    wire:key="{{ $questionId }}"
    class="group grid bg-white border shadow-sm rounded-xl hover:shadow-md focus:outline-none focus:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800"
    href="{{ route('answers', $questionId) }}"
    wire:navigate
>
    <div class="p-4 md:p-5 grid gap-4 ">
        <div class="flex justify-end">
            <p class="flex items-center gap-1 text-sm text-gray-500 dark:text-neutral-500">
                <x-dynamic-component :component="$levelIcon" class="size-3" />
                {{ $level }}
            </p>
        </div>
        <div>
            <h3 class="font-semibold text-gray-800 dark:text-neutral-200">
                {{ $question }}
            </h3>
            <p class="text-sm text-gray-500 dark:text-neutral-500">
                Подается в {{ $percentage }}% случаях
            </p>

            <div class="inline-flex flex-wrap gap-2 my-3">
                @foreach($tags as $tag)
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium {{ $tag['color'] }}">
                        <x-dynamic-component :component="$tag['icon']" class="size-3" />
                        {{ $tag['tag'] }}
                    </span>
                @endforeach
            </div>

        </div>
        <div class="flex items-center text-blue-600 decoration-2 group-hover:text-blue-500 group-hover:dark:text-blue-600 font-medium dark:text-blue-500">
            <span>Перейти к ответу</span>
            <x-mdi-arrow-right class="size-5"/>
        </div>
    </div>
</a>
