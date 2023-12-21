@extends('layouts.app')

@section('content')
    <div class="w-full max-w-xl">
        <h1 class="pb-6 text-2xl sm:text-1xl md:text-2xl lg:text-3xl font-headline font-black tracking-snug text-center leading-12 sm:leading-15 md:leading-19 lg:leading-26 text-gray-800">
            <span class="">Вход</span>
        </h1>
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <blockquote class="p-4 my-4 border-s-4 border-gray-300 bg-gray-50 dark:border-gray-500 dark:bg-gray-800">
                    <p class="text-sm italic font-medium leading-relaxed text-gray-900 dark:text-white">
                        Тестовые данные: <br>
                        E-mail: xnf4o@duck.com <br>
                        Пароль: 7584876dd10d404c3555ac7b905b5222
                    </p>
                </blockquote>
                <label class="block text-gray-700 text-sm font-bold mb-2 flex justify-between" for="email">
                    E-mail
                </label>
                <input
                    class="@error('email') border-red-500 @enderror invalid:border-red-500 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="email" name="email" type="email" placeholder="Например: xnf4o@duck.com" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Пароль
                </label>
                <input
                    class="@error('password') border-red-500 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="password" name="password" type="password" placeholder="******" value="{{ old('password') }}">
                    @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
            </div>
            <div class="flex items-center justify-center">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Войти
                </button>
            </div>
        </form>
    </div>
@endsection
