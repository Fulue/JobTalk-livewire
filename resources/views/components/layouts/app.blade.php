
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}">
<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">


    <!-- Title -->
    <title>{{ $title ?? 'Page Title' }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../favicon.ico">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Theme Check and Update -->
    <script>
        const html = document.querySelector('html');
        const isLightOrAuto = localStorage.getItem('hs_theme') === 'light' || (localStorage.getItem('hs_theme') === 'auto' && !window.matchMedia('(prefers-color-scheme: dark)').matches);
        const isDarkOrAuto = localStorage.getItem('hs_theme') === 'dark' || (localStorage.getItem('hs_theme') === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isLightOrAuto && html.classList.contains('dark')) html.classList.remove('dark');
        else if (isDarkOrAuto && html.classList.contains('light')) html.classList.remove('light');
        else if (isDarkOrAuto && !html.classList.contains('dark')) html.classList.add('dark');
        else if (isLightOrAuto && !html.classList.contains('light')) html.classList.add('light');
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="dark:bg-neutral-900">
    <script>
        HSDropdown.autoInit();
        HSThemeSwitch.autoInit();
    </script>

    <header class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-[48] w-full bg-gray-900 border-b text-sm py-2.5  dark:bg-neutral-950 dark:border-neutral-700">
        <nav class="max-w-[85rem] mx-auto w-full flex md:grid md:grid-cols-3 md:gap-x-1 basis-full items-center px-4 sm:px-6 lg:px-8">
            <div class="me-5">
                <a
                    wire:navigate
                    class="flex items-center gap-2 rounded-md text-xl font-semibold focus:outline-none focus:opacity-80"
                    href="/"
                    aria-label="JobTalk">
                    <x-mdi-bicycle class="size-6 text-white" />
                    <span class="text-white text-sm">
                        JobTalk
                    </span>
                </a>
            </div>
            <div>

            </div>

            <div class="flex-1 flex flex-row justify-end items-center gap-1">

                <button type="button" class="size-[38px] relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 disabled:opacity-50 disabled:pointer-events-none hs-dark-mode hs-dark-mode-active:hidden block" data-hs-theme-click-value="dark">
                    <x-mdi-lightbulb-outline class="size-4"/>
                </button>
                <button type="button" class="size-[38px] relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 disabled:opacity-50 disabled:pointer-events-none hs-dark-mode hs-dark-mode-active:inline-flex hidden" data-hs-theme-click-value="light">
                    <x-mdi-lightbulb-on-outline class="size-4"/>
                </button>
            </div>

        </nav>
    </header>

    <main class="content max-w-6xl mx-auto">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
