<div class="flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
    <div class="relative w-full">
        <input
            type="text"
            class="py-3 pe-0 ps-8 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
            placeholder="Поиск по вопросам"
        >
        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
            <x-mdi-magnify class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"/>
        </div>
    </div>
    <div class="flex justify-end gap-3 items-center">
        @if($filtered)
            <button
                x-on:click.prevent="$wire.filterClear()"
                class="flex items-center gap-1 text-gray-600 hover:text-gray-500 dark:text-neutral-400 hover:dark:text-neutral-500"
            >
                <x-mdi-restore class="size-4"/>
                Сбросить
            </button>
        @endif
        <div class="flex gap-3">
            <div class="hs-dropdown [--strategy:absolute] [--flip:false] [--placement:bottom-right] hs-dropdown-example relative inline-flex">
                <button
                        id="hs-dropdown-example"
                        type="button"
                        class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-haspopup="menu"
                        aria-expanded="false"
                        aria-label="Dropdown"
                >
                    Тема
                    <x-mdi-tag-outline class="size-4"/>
                </button>
                <div
                        class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="hs-dropdown-transform-style"
                >
                    <div class="hs-dropdown-open:ease-in hs-dropdown-open:opacity-100 hs-dropdown-open:scale-100 transition ease-out opacity-0 scale-95 duration-200 mt-2 origin-top-left min-w-60 bg-white shadow-md rounded-lg dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" data-hs-transition>
                        <div class="p-1 space-y-0.5">
                            @if(count($tags) == 0)
                                <p class="py-2 px-3 text-sm text-gray-600 dark:text-neutral-400">Темы не найдены</p>
                            @endif
                            @foreach($tags as $tag)
                                <a
                                        x-on:click.prevent="$wire.setTag('{{ $tag['id'] }}'); $wire.filtered = true;"
                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        href="#"
                                >
                                    <x-dynamic-component :component="$tag['icon']" class="size-4" />
                                    {{ $tag['tag'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="hs-dropdown [--strategy:absolute] [--flip:false] [--placement:bottom-right] hs-dropdown-example relative inline-flex">
                <button
                    id="hs-dropdown-example"
                    type="button"
                    class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    aria-haspopup="menu"
                    aria-expanded="false"
                    aria-label="Dropdown"
                >
                    Уровень
                    <x-mdi-briefcase-outline class="size-4"/>
                </button>
                <div
                    class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="hs-dropdown-transform-style"
                >
                    <div class="hs-dropdown-open:ease-in hs-dropdown-open:opacity-100 hs-dropdown-open:scale-100 transition ease-out opacity-0 scale-95 duration-200 mt-2 origin-top-left min-w-44 bg-white shadow-md rounded-lg dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" data-hs-transition>
                        <div class="p-1 space-y-0.5">
                            @if(count($levels) == 0)
                                <p class="py-2 px-3 text-sm text-gray-600 dark:text-neutral-400">Уровни не найдены</p>
                            @endif
                            @foreach($levels as $level)
                                <a
                                    x-on:click.prevent="$wire.setLevel('{{ $level['id'] }}'); $wire.filtered = true;"
                                    class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    href="#"
                                >
                                    <x-dynamic-component :component="$level['icon']" class="size-4" />
                                    {{ $level['level'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
