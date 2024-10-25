<a
    wire:key="{{ $questionId }}"
    class="group grid bg-white border shadow-sm rounded-xl hover:shadow-md focus:outline-none focus:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800"
    href="{{ route('answers', $questionId) }}"
    wire:navigate
>
    <div class="flex justify-between p-4 md:p-5 gap-4 ">
        <div>
            <h3 class="font-semibold text-gray-800 dark:text-neutral-200">
                {{ $question }}
            </h3>
            <p class="text-sm text-gray-500 dark:text-neutral-500">
                Подается в {{ $percentage }}% случаях
            </p>

        </div>
        <div class="flex items-center text-blue-600 decoration-2 group-hover:text-blue-500 group-hover:dark:text-blue-600 font-medium dark:text-blue-500">
            <span class="hidden lg:flex" >Перейти к ответу</span>
            <x-mdi-arrow-right class="size-5"/>
        </div>
    </div>
</a>
