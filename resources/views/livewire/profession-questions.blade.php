<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">

    <div class="max-w-2xl mb-10">
        <div>
            <x-dynamic-component :component="$profession->icon" :class="$profession->icon_color . ' size-14'" />
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">{{ $profession->profession }} - Вопросы</h2>
        </div>
        <p class="mt-1 text-gray-600 dark:text-neutral-400">Список вопросов для вашей профессии</p>
    </div>

    @if(count($this->questions) == 0)
        <p>Для этой профессии пока нет вопросов.</p>
    @else
        <div class="max-w-[85rem] py-10 lg:py-14 mx-auto">
            <div class="grid md:grid-cols-2 gap-3 sm:gap-6">

                @foreach($this->questions as $question)
                    <a class="group grid bg-white border shadow-sm rounded-xl hover:shadow-md focus:outline-none focus:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800" href="#">
                        <div class="p-4 md:p-5 grid gap-4 ">
                            <div class="flex justify-end">
                                <p class="flex items-center gap-1 text-sm text-gray-500 dark:text-neutral-500">
                                    <x-dynamic-component :component="$question['level_icon']" class="size-3" />
                                    {{ $question['level'] }}
                                </p>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-neutral-200">
                                    {{ $question['question'] }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-neutral-500">
                                    Подается в {{ $question['percentage'] }}% случаях
                                </p>
                                <div class="flex gap-1 my-2">
                                    @foreach($question['tags'] as $tags)
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium {{$tags['color']}}"
                                        >
                                        {{$tags['tag']}}
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
                @endforeach

            </div>
        </div>
    @endif

</div>
