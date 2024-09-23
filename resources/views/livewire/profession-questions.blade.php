<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">

    <div class="max-w-2xl mb-10">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">{{ $profession->profession }} - Вопросы</h2>
        <p class="mt-1 text-gray-600 dark:text-neutral-400">Список вопросов для вашей профессии</p>
    </div>

    @if(count($this->questions) == 0)
        <p>Для этой профессии пока нет вопросов.</p>
    @else
        <div class="max-w-[85rem] py-10 lg:py-14 mx-auto">
            <div class="grid md:grid-cols-2 gap-3 sm:gap-6">

                @foreach($this->questions as $question)
                    <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md focus:outline-none focus:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800" href="#">
                        <div class="p-4 md:p-5">
                            <div class="flex justify-between items-center gap-x-3">
                                <div class="grow">
                                    <h3 class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-neutral-400 dark:text-neutral-200">
                                        {{ $question['question'] }}
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-neutral-500">
                                        Подается в {{ $question['percentage'] }}% случаях
                                    </p>
                                </div>
                                <div>
                                    <svg class="shrink-0 size-5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    @endif

</div>
