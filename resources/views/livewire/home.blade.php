<div>
    <div class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/squared-bg-element.svg')] dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/squared-bg-element.svg')] before:bg-no-repeat before:bg-top before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">

            <x-home.page-title title="Подготовка к собеседованию в IT" />
            <x-home.page-description description="Сервис с вопросами и ответами для подготовки к техническим интервью в IT." />

            <div class="mt-8 gap-3 flex justify-center">
                <x-ui.button url="#" icon="mdi-github">Перейти на Github</x-ui.button>
            </div>
        </div>
    </div>

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-6">
            @foreach ($professions as $profession)
                <x-home.profession-card
                    :professionId="$profession['id']"
                    :icon="$profession['icon']"
                    :iconColor="$profession['icon_color']"
                    :profession="$profession['profession']"
                    :count="$profession['count']"
                />
            @endforeach
        </div>
    </div>

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="max-w-2xl text-center mx-auto mb-10 lg:mb-14">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Преимущества сервиса</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 items-center gap-12">
            <x-home.service-benefit
                icon="mdi-comment-question-outline"
                title="Актуальные вопросы"
                description="Мы обновляем базу вопросов, следя за новыми требованиями рынка."
            />
            <x-home.service-benefit
                icon="mdi-book-outline"
                title="Глубокие объяснения"
                description="Каждый вопрос сопровождается детализированными объяснениями."
            />
            <x-home.service-benefit
                icon="mdi-cog-outline"
                title="Реальные задачи"
                description="Вопросы основаны на реальных интервью из IT-компаний."
            />
            <x-home.service-benefit
                icon="mdi-cellphone-link"
                title="Удобный интерфейс"
                description="Простая навигация и фильтрация по профессиям."
            />
        </div>
    </div>
</div>
