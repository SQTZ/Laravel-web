<x-app-layout>
    <title>{{ $article->Code_article }}</title>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>


        <!--Barre de navigation-->
        @include('partials.search');



        <a class="bg-red-500 px-3 py-1 rounded-lg text-white" href="#">Créer</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <p>{{ $article->Version }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
