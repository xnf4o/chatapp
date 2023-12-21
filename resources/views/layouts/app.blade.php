<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite('resources/css/app.css')
</head>
<body class="antialiased">
<div id="app">
    <header class="bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="/" class="-m-1.5 p-1.5">
                    <svg class="h-8 w-auto" width="42" height="42" viewBox="0 0 42 42" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M17.6066 13.6534C17.6638 13.6344 17.721 13.6153 17.7782 13.5772C17.7782 13.5772 17.7782 13.5772 17.7973 13.5772C18.5601 13.1958 19.0749 12.4139 19.0749 11.4986C19.0749 11.2888 19.0559 11.0982 18.9987 10.9075C18.9605 10.7549 18.9033 10.6214 18.8461 10.4879C18.4647 9.72516 17.6829 9.19122 16.7675 9.19122C16.4624 9.19122 16.1764 9.24843 15.9094 9.34378C11.4281 11.2698 8.30078 15.7129 8.30078 20.8998C8.30078 27.8601 13.9453 33.4855 20.9056 33.4855C22.393 33.4855 23.8422 33.2376 25.1771 32.7418C25.1771 32.7418 25.1771 32.7418 25.1962 32.7418C25.2915 32.7037 25.4059 32.6655 25.5203 32.6274C26.0352 32.3795 26.4357 31.9409 26.6645 31.426C26.7789 31.14 26.8552 30.8349 26.8552 30.5298C26.8552 29.6144 26.3213 28.8135 25.5585 28.4321C25.2534 28.2987 24.8911 28.2033 24.5287 28.2033C24.2618 28.2033 23.9948 28.2605 23.7469 28.3368C22.8697 28.661 21.8972 28.8517 20.9056 28.8517C16.5006 28.8517 12.9537 25.2857 12.9537 20.8998C12.9537 17.6771 14.8606 14.912 17.6066 13.6534Z"
                              fill="#25B372"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M28.8518 21.1478V24.9045V32.0936V33.3713V35.0303C26.4872 36.3651 23.7603 37.1279 20.8809 37.1279C11.9374 37.1279 4.63384 29.8244 4.63384 20.8809C4.63384 11.9564 11.9374 4.63384 20.8809 4.63384C29.5383 4.63384 36.6702 11.4988 37.1088 20.0609V20.6139V21.7199V31.1402V33.9815V38.539C37.1088 39.8167 38.1386 40.8464 39.4162 40.8464C39.4925 40.8464 39.5878 40.8464 39.6641 40.8274C40.8274 40.7129 41.7427 39.7213 41.7427 38.539V21.8343V19.9465C41.7236 19.9083 41.7236 19.8893 41.7236 19.8702C41.1897 8.84815 32.0173 0 20.8809 0C9.40116 0 0 9.40116 0 20.8809C0 26.9449 2.61249 32.4178 6.7696 36.2317C9.09605 38.3865 11.9374 40.0264 15.0647 40.9418C16.9145 41.4757 18.8595 41.7618 20.8809 41.7618C25.1333 41.7618 29.0997 40.465 32.3987 38.2721C32.4178 38.253 32.4369 38.253 32.4369 38.253C32.4559 38.2339 32.4941 38.2149 32.5131 38.1958C33.0852 37.7953 33.4666 37.1279 33.4857 36.3842C33.4857 36.3651 33.4857 36.327 33.4857 36.3079C33.4857 36.2698 33.4857 36.2507 33.4857 36.2126V36.041V32.0936V31.102V21.1478V20.8999C33.4857 14.9694 29.3667 9.97324 23.8366 8.65746C23.665 8.61932 23.4934 8.60025 23.3027 8.60025C22.9594 8.60025 22.6352 8.67653 22.3301 8.81001C21.5483 9.1914 20.9953 9.99231 20.9953 10.9076C20.9953 11.842 21.5483 12.6429 22.3301 13.0243C22.4446 13.0625 22.578 13.1197 22.7115 13.1578C26.2203 13.9778 28.8518 17.1433 28.8518 20.8999C28.8518 20.9762 28.8518 21.0716 28.8328 21.1478H28.8518Z"
                              fill="#0189CB"/>
                    </svg>
                </a>
            </div>
            @if (Auth::check())
                <div class="lg:flex lg:gap-x-12">
                    <a href="{{ route('task.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Мои
                        рассылки</a>
                    <a href="{{ route('task.create') }}" class="text-sm font-semibold leading-6 text-gray-900">Создать
                        рассылку</a>
                </div>
            @endif
            <div class="lg:flex lg:flex-1 lg:justify-end">
                @if (!Auth::check())
                    <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900 inline-flex">Войти
                        &nbsp;
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" data-slot="icon" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('logout') }}" class="text-sm font-semibold leading-6 text-gray-900 inline-flex">Выйти
                        &nbsp;
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" data-slot="icon" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/>
                        </svg>
                    </a>
                @endif
            </div>
        </nav>
    </header>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="w-full mx-auto">

            <div class="flex justify-center">
                @yield('content')
            </div>

            <p class="text-center text-gray-500 text-xs footer">
                &copy; 2023 <b>xnf4o</b>
                <br>
                Тестовое задание <a href="https://spb.hh.ru/vacancy/90542169" target="_blank">ChatApp</a>
                <br>
                <b>credits:</b> <a href="https://tailwindcss.com/" target="_blank">Tailwindcss</a>, <a href="https://heroicons.com/" target="_blank">HeroIcons</a>
                <br>
            <div class="flex mt-4 sm:justify-center sm:mt-0">
                <a href="https://github.com/xnf4o/chatapp" target="_blank" class="text-gray-500 mt-6 hover:text-gray-900 dark:hover:text-white ms-5">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                         viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">GitHub account</span>
                </a>
            </div>
            </p>
        </div>
    </div>
</div>
</body>
</html>
