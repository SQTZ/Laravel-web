<x-app-layout>
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
                <h1>Liste des produits</h1>
                
                @foreach($articles as $article)
                <a href="{{ url("show/{$article->Code_article}")}}">{{ $article->Code_article }}</a>
                {{ $article->Version }}
                {{ $article->Date }}
                @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
