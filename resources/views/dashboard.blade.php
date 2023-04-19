<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>


        <!--Barre de navigation-->
        @include('partials.search')



        <a class="bg-red-500 px-3 py-1 rounded-lg text-white" href="#">Créer</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1>Liste des produits</h1>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Code_article</th>
                            <th scope="col">MAT</th>
                            <th scope="col">EMB</th>
                            <th scope="col">MOD</th>
                            <th scope="col">FF</th>
                            <th scope="col">MC</th>
                            <th scope="col">PV</th>
                            <th scope="col">Version</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <th scope="row">{{ $article->Code_article }}</th>
                            <th scope="row">{{ $article->MAT }}</th>
                            <th scope="row">{{ $article->EMB }}</th>
                            <th scope="row">{{ $article->MOD }}</th>
                            <th scope="row">{{ $article->FF }}</th>
                            <th scope="row">{{ $article->MC }}</th>
                            <th scope="row">{{ $article->PV }}</th>
                            <th scope="row">{{ $article->Version }}</th>
                            <th scope="row">{{ $article->Date }}</th>

                            <th scope="row"><a href="{{ url("show/{$article->Code_article}")}}">Visualiser</a></th>
                            <th scope="row">Modifier</th>
                            <th scope="row">Supprimer</th>
                        </tr>

                @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
