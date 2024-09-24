<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">

    <x-profession-questions.title-with-icon
        :icon="$profession['icon']"
        :icon-color="$profession['icon_color']"
        title="{{ $profession['profession'] }} - Вопросы"
        description="Список вопросов для вашей профессии"
    />

    <x-profession-questions.dropdown-filter :levels="$profession['levels']" :profession-id="$profession['id']" />

    @if(count($this->questions) == 0)
        <x-profession-questions.empty-list />
    @else
        <div class="max-w-[85rem] py-10 lg:py-14 mx-auto">
            <div class="grid md:grid-cols-2 gap-3 sm:gap-6">
                @foreach($this->questions as $question)
                    <x-profession-questions.question-item
                        :question="$question['question']"
                        :percentage="$question['percentage']"
                        :tags="$question['tags']"
                        :level="$question['level']"
                        :level-icon="$question['level_icon']"
                    />
                @endforeach
            </div>
        </div>
    @endif

</div>
