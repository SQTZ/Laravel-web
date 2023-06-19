<head>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>Appliweb - Show n°{{ $Code_dossier }}</title>
</head>


<x-app-layout>
<div id="loading" class="fixed inset-0 flex items-center justify-center text-2xl font-semibold text-black bg-gray-900 z-50">
    <!-- Ici, vous pouvez mettre l'animation de chargement que vous préférez. -->
    <div class="animate-spin rounded-full h-32 w-32 border-t-4 border-b-4 border-blue-500"></div>
</div>

    <x-slot name="header">
        @include('partials.menu')
    </x-slot>

    <div class="py-12 mx-8">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold">Code dossier : <span class="text-blue-500 font-medium text-xl">{{ $Code_dossier }}</span></h1>

                    <h2 class="text-gray-400">Choisissez une donnée parmi les versions disponibles</h2>
                    <div class="grid grid-cols-5 md:grid-cols-10 gap-3 mt-3">
                        @foreach($uniqueVersions as $version)
                        <a href="{{ route('editor.show', ['Code_dossier' => $Code_dossier, 'version' => $version]) }}" class="text-lg border-2 border-blue-500 px-2 py-1 rounded-lg text-blue-500 hover:bg-blue-500 hover:text-white duration-150 text-center">v{{ $version }}</a>
                        @endforeach
                    </div>



                </div>
            </div>

            <!--Affichage de l'historique et du graphique-->
            <div class="flex md:justify-between md:flex-row flex-col gap-8 mt-24">

                <!--Graphique-->
                <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl p-4">
                    <h2 class="text-2xl font-bold text-white">Graphique</h2>
                    <p class="text-gray-400 mb-4">Retrouvez graphiquement les prix de vente selon l'entité designé. <a href="/documentation#graphique" class="text-blue-500 hover:underline">En savoir plus</a></p>
                    <div class="w-96">
                    </div>

                    {!! $chart->container() !!}

                    {!! $chart->script() !!}

                    <h3 class="text-xl font-bold text-white">Avancés</h3>

                    <!--Exemple du résultat (in developpement)-->
                    <p class="text-gray-400">Ici s'afficheront les résultats obtenus dû au calcul entre la dernière version et la nouvelle version.</p>
                    <div class="flex justify-between items-center mt-6">

                        <div class="grid gap-4">
                            <div class="border-2 border-blue-500 flex px-4 py-2 rounded-lg gap-4">
                            <p class="text-gray-400">Prix de vente maximum:</p>
                            <p class="text-green-500">{{ $pvMax }}€</p>
                            </div>

                            <div class="border-2 border-blue-500 flex px-4 py-2 rounded-lg gap-4">
                            <p class="text-gray-400">Prix de vente minimum:</p>
                            <p class="text-red-500">{{ $pvMin }}€</p>
                            </div>
                    </div>

                    <div>
                        <div class="border-2 border-blue-500 flex px-4 py-2 rounded-lg gap-4">
                        <p class="text-gray-400">Résultat obtenu:</p>
                        <p style="color: {{ $lastPercentageChange >= 0 ? 'green' : 'red' }}"><?= $lastPercentageChange ?></p>
                        </div>
                        </div>
                    </div>

                </div>



                <!--Historique-->
                <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl p-4">
                    <h2 class="text-2xl font-bold text-white">Historique</h2>
                    <p class="text-gray-400 mb-4">Suivez les informations de votre entité dans cet historique. <a href="/documentation#historique" class="text-blue-500 hover:underline">En savoir plus</a></p>
                    <div class="overflow-y-scroll max-h-96">
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
    </div>

</x-app-layout>

<script>
    window.addEventListener('load', () => {
        const loadingScreen = document.getElementById('loading');
        loadingScreen.style.display = 'none';
    });
</script>