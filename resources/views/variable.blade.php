<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Appliweb - Variables</title>
</head>

<x-app-layout>
<div id="loading" class="fixed inset-0 flex items-center justify-center text-2xl font-semibold text-black bg-gray-900 z-50">
    <!-- Ici, vous pouvez mettre l'animation de chargement que vous préférez. -->
    <div class="animate-spin rounded-full h-32 w-32 border-t-4 border-b-4 border-blue-500"></div>
</div>

<x-slot name="header">
        @include('partials.menu')
    </x-slot>

    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-16 pt-16">
        <div class="flex md:flex-row flex-col justify-between gap-8">

            <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl p-4 mx-4">
                <h1 class="text-2xl font-bold text-white">Variables</h1>
                <h2 class="text-gray-400 mb-4">Ici, vous devrez inscrire vos variables si vous voulez pas que vos calculs ne soient pas faussés ou corrompus. Un souci ? Regardez la <a href="/documentation#variables" class="text-blue-500 hover:underline">Documentation</a>.</h2>

                <div class="gap-10 justify-center items-center mt-10 grid grid-cols-1">
                    <div class="flex flex-col">
                        <h3 class="text-lg text-white">Taux Horaire</h3>
                        <input type="text" placeholder="Exemple: 12.5" id="TauxHoraire" class="h-10 px-4 bg-gray-700 text-gray-300 focus:outline-none rounded-md border-2 border-blue-500">
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-lg text-white">Coût FF</h3>
                        <input type="text" placeholder="Exemple: 24.2" id="CoutFF" class="h-10 px-4 bg-gray-700 text-gray-300 focus:outline-none rounded-md border-2 border-blue-500">
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-lg text-white">Coût Bobine</h3>
                        <input type="text" placeholder="Exemple: 3.27" id="CoutBobine" class="h-10 px-4 bg-gray-700 text-gray-300 focus:outline-none rounded-md border-2 border-blue-500">
                    </div>


                </div>

                <div>
                    <button type="button" id="btnPush" class="w-full mt-10 border-2 border-green-500 text-green-500 px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white duration-150">Ajouter</button>
                </div>
            </div>

            <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl p-4 mx-4">
                <h2 class="text-2xl font-bold text-white">Informations actives</h2>
                <p class="text-gray-400 mb-4">Retrouvez les dernières informations inscrites dans la base de données.</p>
                <div class="max-h-96">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-800 text-white">
                                <th class="py-2 px-4 text-left">Taux Horaire</th>
                                <th class="py-2 px-4 text-left">Coût FF</th>
                                <th class="py-2 px-4 text-left">Coût Bobine</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datalist as $data)
                            <tr class="bg-gray-700 text-gray-300">
                                <td class="py-2 px-4">{{ $data->Taux_horaire }}</td>
                                <td class="py-2 px-4">{{ $data->Cout_ff }}</td>
                                <td class="py-2 px-4">{{ $data->Cout_bobine }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>









</x-app-layout>

<script>
    //Requête ajax pour récupérer les données de la table variables

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btnPush').click(function(event) {
            event.preventDefault();

            console.log($('#TauxHoraire').val());
            console.log($('#CoutFF').val());
            console.log($('#CoutBobine').val());

            $.ajax({
                url: '/fetch-variable',
                type: 'POST',
                dataType: 'json',
                data: {
                    Taux_horaire: $('#TauxHoraire').val(),
                    Cout_ff: $('#CoutFF').val(),
                    Cout_bobine: $('#CoutBobine').val()
                },

                success: function(response) {
                    if (response) {
                        console.log(response);
                        alert('Données envoyées');

                        window.location.href = "/variable";
                    } else {
                        alert('Erreur');
                    }
                }
            });
        });

    });
</script>

<script>
    window.addEventListener('load', () => {
        const loadingScreen = document.getElementById('loading');
        loadingScreen.style.display = 'none';
    });
</script>