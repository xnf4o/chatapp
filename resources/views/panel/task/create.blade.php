@extends('layouts.app')

@section('content')
    <div class="w-full max-w-xl">
        <h1 class="pb-6 text-2xl sm:text-1xl md:text-2xl lg:text-3xl font-headline font-black tracking-snug text-center leading-12 sm:leading-15 md:leading-19 lg:leading-26 text-gray-800">
            <span class="">Создание рассылки</span>
        </h1>
        <form class="bg-white shadow-md rounded-xl px-8 pt-6 pb-8 mb-4" method="POST"
              action="{{ route('task.create') }}">
            @csrf
            <div class="border-gray-900/10">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Номера</label>
                        <div class="mt-2">
                                <textarea id="about" name="numbers" rows="3"
                                          class="@error('numbers') border-red-500 @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('numbers') }}</textarea>
                        </div>
                        @error('numbers')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        <p class="mt-3 text-sm leading-6 text-gray-600">Введите номера, на которые должна осуществиться
                            рассылка.<br>Каждый номер с новой строки. <br>Игнорируются номера: <br> Начинающиеся не с 7
                            <br>Длиннее или короче 11 цифр </p>
                    </div>

                    <div class="col-span-full">
                        <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Текст
                            рассылки</label>
                        <div class="mt-2">
                                <textarea id="about" name="message" rows="3"
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Начать рассылку
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection
