<head>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>


<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex">
                <p><a class="text-white" href="../dashboard">Retour</a></p>
            </div>


            <!--Barre de navigation-->
            @include('partials.search')



            <a class="bg-red-500 px-3 py-1 rounded-lg text-white" href="#">Créer</a>
        </div>
    </x-slot>

    <div class="py-12 mx-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Code dossier : {{ $Code_dossier }}</h1>

                    <div class="flex gap-4">

                        @foreach($uniqueVersions as $version)
                        <a href="{{ route('editor.show', ['Code_dossier' => $Code_dossier, 'version' => $version]) }}" class="hover:text-blue-500 text-xl">v{{ $version }}</a>
                        @endforeach


                    </div>



                </div>
            </div>

            <!--Affichage de l'historique et du graphique-->
            <div class="flex md:justify-between md:flex-row flex-col gap-8 mt-24">

                <!--Graphique-->
                <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl p-4">
                    <h2 class="text-2xl font-bold text-white">Graphique</h2>
                    <p class="text-gray-400 mb-4">Retrouvez graphiquement les prix de vente selon l'entité designé.</p>
                    <div class="w-96">
                    
                    </div>

                    {!! $chart->container() !!}


                    {!! $chart->script() !!}




                    <h3 class="text-xl font-bold text-white">Avancés</h3>
                    
                </div>




                <!--Historique-->
                <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl p-4">
                    <h2 class="text-2xl font-bold text-white">Historique</h2>
                    <p class="text-gray-400 mb-4">Suivez les informations de votre entité dans cet historique.</p>
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-800 text-white">
                                <th class="py-2 px-4 text-left">Version(s)</th>
                                <th class="py-2 px-4 text-left">Date(s)</th>
                                <th class="py-2 px-4 text-left">Modifié par</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($versions->sortByDesc('Version') as $record)
    <tr class="bg-gray-700 text-gray-300">
        <td class="py-2 px-4">{{ $record->Version }}</td>
        <td class="py-2 px-4">{{ $record->updated_at->format('d/m/Y') }}</td>
        <td class="py-2 px-4">{{ Auth::user()->name }}</td>
    </tr>
@endforeach

                        </tbody>
                    </table>
                </div>


            </div>

        </div>
    </div>

</x-app-layout>