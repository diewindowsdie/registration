<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    @stack('head')
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900">
<div class="antialiased bg-gray-50 dark:bg-gray-900" id="app">
    <nav
        class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
        <div class="flex flex-wrap justify-between items-center">
            <div class="flex justify-start items-center">
                <button
                    data-drawer-target="drawer-navigation"
                    data-drawer-toggle="drawer-navigation"
                    aria-controls="drawer-navigation"
                    class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    <svg
                        aria-hidden="true"
                        class="w-6 h-6"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <svg
                        aria-hidden="true"
                        class="hidden w-6 h-6"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="sr-only">{{ __("layout.menu.toggle") }}</span>
                </button>
                <a href="{{ route('index') }}" class="flex items-center justify-between mr-4">
                    <svg class="mr-3 h-8" viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
                        <!-- Голубой круг -->
                        <circle cx="150" cy="150" r="120" fill="#D0EBF7"/>
                        <!-- Лук -->
                        <path d="M90 70 Q60 150, 90 230" fill="none" stroke="#5A381E" stroke-width="8"
                              stroke-linecap="round"/>
                        <!-- Тетива -->
                        <line x1="90" y1="70" x2="90" y2="230" stroke="#2F2F2F" stroke-width="4"/>
                        <!-- Стрела -->
                        <line x1="85" y1="150" x2="180" y2="150" stroke="#2F2F2F" stroke-width="6"
                              stroke-linecap="round"/>
                        <!-- Увеличенный наконечник стрелы -->
                        <polygon points="180,150 160,135 160,165" fill="#E63946"/>
                    </svg>
                    <span
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">@yield('title')</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->

    <aside
        class="fixed top-0 left-0 z-40 w-[17.5rem] h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidenav"
        id="drawer-navigation"
    >
        <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
            <navigation-menu
                :competitions="{{ $competitions }}"
                :current-competition="{{ $competition ?? 'null' }}"
                :is-secretary="{{ \App\Auth\ClientCertificateOrBasicAuthAuthenticator::isAuthenticated() ? 1 : 0 }}"
                route-registration-form="{{ route('competitions.registrationForm', ':competition_id') }}"
                route-participants-list="{{ route('competitions.participants', ':competition_id') }}"
                route-edit-competition="{{ route('competitions.edit', ':competition_id') }}"
                route-new-competition="{{ route('competitions.new') }}"
                route-delete-competition="{{ route('competitions.delete', ':competition_id') }}"
                route-load-upcoming-competitions="{{ route('competitions.loadUpcoming') }}"
            ></navigation-menu>
        </div>
        <div
            class="absolute bottom-0 left-0 justify-center p-6 space-x-4 w-full flex bg-white dark:bg-gray-800 z-20 border-r border-gray-200 dark:border-gray-700">
            <button id="theme-toggle" type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
                <svg
                    id="theme-toggle-auto-icon"
                    class="hidden w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m7.5 2c-1.79 1.15-3 3.18-3 5.5s1.21 4.35 3.03 5.5c-3.07 0-5.53-2.46-5.53-5.5a5.5 5.5 0 0 1 5.5-5.5m11.57 1.5 1.43 1.43-15.57 15.57-1.43-1.43zm-6.18 2.43-1.48-.93-1.44 1 .42-1.7-1.39-1.06 1.75-.12.58-1.65.67 1.63 1.73.03-1.35 1.13zm-3.3 3.61-1.16-.73-1.12.78.34-1.32-1.09-.83 1.36-.09.45-1.29.51 1.27 1.36.03-1.05.87zm9.41 3.96a5.5 5.5 0 0 1 -5.5 5.5c-1.22 0-2.35-.4-3.26-1.07l7.69-7.69c.67.91 1.07 2.04 1.07 3.26m-4.4 6.58 2.77-1.15-.24 3.35zm4.33-2.7 1.15-2.77 2.2 2.54zm1.15-4.96-1.14-2.78 3.34.24zm-10.45 6.51 2.77 1.15-2.53 2.19z"/>
                </svg>
            </button>
        </div>
    </aside>

    <main class="p-4 md:ml-[17.5rem] h-auto pt-20">
        @yield('content')
    </main>
</div>
</body>
</html>
