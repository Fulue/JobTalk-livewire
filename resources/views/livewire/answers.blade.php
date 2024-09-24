<div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
    <div class="mb-10">
        <h2 class="text-xl font-bold md:text-2xl md:leading-tight dark:text-white">{{ $this->question['question'] }}</h2>
        <p class="mt-1 text-gray-600 dark:text-neutral-400">Ответ на вопрос по професии <b>{{  $this->question['profession'] }}</b> уровня <b>{{ $this->question['level'] }}</b></p>
    </div>

    @if(count($this->question['answers']) == 0)
        <x-profession-questions.empty-list />
    @else
        <div class="max-w-[85rem] py-10 lg:py-14 mx-auto">
            <div class="grid gap-3 sm:gap-6">
                @foreach($this->question['answers'] as $answer)
                    <div class="grid gap-3">
                        <div class="bg-gray-100 rounded-xl p-6 dark:bg-white/5">
                            <p class="text-gray-800 dark:text-neutral-200">
                                {{$answer['answer']}}
                            </p>
                        </div>
                        <div class="flex gap-1 items-center justify-end text-gray-600 dark:text-neutral-400">
                            <x-mdi-clock-time-eight-outline class="size-4" />
                            <span class="text-sm">
                                {{ $answer['created_at'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
