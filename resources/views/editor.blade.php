<x-app-layout>
    <div id="loading" class="fixed inset-0 flex items-center justify-center text-2xl font-semibold text-black bg-gray-900 z-50">
        <!-- Ici, vous pouvez mettre l'animation de chargement que vous préférez. -->
        <div class="animate-spin rounded-full h-32 w-32 border-t-4 border-b-4 border-blue-500"></div>
    </div>

    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>



    <table id="resultTable" class="m-auto mt-5 mb-24">
        <thead>
            <tr>
                <th class="border border-gray-300 p-2 text-white">Code_dossier</th>
                <th class="border border-gray-300 p-2 text-white">MAT</th>
                <th class="border border-gray-300 p-2 text-white">EMB</th>
                <th class="border border-gray-300 p-2 text-white">MOD</th>
                <th class="border border-gray-300 p-2 text-white">FF</th>
                <th class="border border-gray-300 p-2 text-white">TOTAL</th>
                <th class="border border-gray-300 p-2 text-white">MC</th>
                <th class="border border-gray-300 p-2 text-white">PV</th>
            </tr>
        </thead>
        @if(isset($dossier))
        <tbody>
            <tr id="resultTD">
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" name="Code_dossier" id="Code_dossier" value="{{ $dossier->Code_dossier }}"></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultMAT" value="{{ $dossier->MAT }}" oninput="CalculTotal()" readonly></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultEMB" value="{{ $dossier->EMB }}" oninput="CalculTotal()" readonly></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultMOD" value="{{ $dossier->MOD }}" oninput="CalculTotal()" readonly></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultFF" value="{{ $dossier->FF }}" readonly></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultTOTAL" value="{{ $dossier->TOTAL }}" oninput="CalculFinal()" readonly></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultMC" value="{{ $dossier->MC }}" onchange="CalculFinal()"></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultPV" value="{{ $dossier->PV }}" readonly></td>

            </tr>

        </tbody>

        <div class="flex justify-center gap-24 items-center my-10">
        <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl flex px-8 py-4 gap-10">
        <div class="flex gap-4">
                <button type="button" class="border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white duration-150 py-2 px-4 rounded-lg" onclick="updateValuesMAT()">Calculer MAT</button>
                <button type="button" class="border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white duration-150 py-2 px-4 rounded-lg" onclick="updateValuesEMB()">Calculer EMB</button>
                <button type="button" class="border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white duration-150 py-2 px-4 rounded-lg" onclick="updateValuesMOD()">Calculer MOD</button>
            </div>

            <button id="btnPush" class="border-2 border-yellow-500 text-yellow-500 px-4 py-2 rounded-lg hover:bg-yellow-500 hover:text-white duration-150">Modifier</button>
        </div>
        </div>


        @else
        <tbody>
            <tr id="resultTD">
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" name="Code_dossier[]" id="Code_dossier"></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultMAT" oninput="CalculTotal()" readonly></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultEMB" oninput="CalculTotal()" readonly></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultMOD" oninput="CalculTotal()" readonly></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultFF" readonly></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultTOTAL" oninput="CalculFinal()" readonly></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultMC" onchange="CalculFinal()"></td>
                <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultPV" readonly></td>
                <!--<td><input type="hidden" id="new_session"></td>-->
            </tr>
        </tbody>
        <div class="flex justify-center gap-24 items-center my-10">
        <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl flex px-8 py-4 gap-10">
            <div class="flex gap-4">
                <button type="button" class="border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white duration-150 py-2 px-4 rounded-lg" onclick="updateValuesMAT()">Calculer MAT</button>
                <button type="button" class="border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white duration-150 py-2 px-4 rounded-lg" onclick="updateValuesEMB()">Calculer EMB</button>
                <button type="button" class="border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white duration-150 py-2 px-4 rounded-lg" onclick="updateValuesMOD()">Calculer MOD</button>
            </div>

            <button id="btnPush" class="border-2 border-green-500 text-green-500 px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white duration-150">Créer</button>
        </div>
        </div>
        @endif


    </table>

    <!--J'inclus mes layouts MAT, EMB, MOO et FF pour activer le mode calcul-->
    <div class="grid gap-8">
    @include('layouts.mat')
    @include('layouts.emb')
    @include('layouts.moo')
    </div>


    <script>
        //Va calculer le MAT, EMB, MOD et FF pour obtenir le résultat dans TOTAL
        function CalculTotal() {
            var resultMAT = parseInt(document.getElementById("resultMAT").value) || 0;
            var resultEMB = parseInt(document.getElementById("resultEMB").value) || 0;
            var resultMOO = parseInt(document.getElementById("resultMOD").value) || 0;
            var resultFF = parseInt(document.getElementById("resultFF").value) || 0;

            // Je crée ma formule et je l'affiche dans l'input result pt.1
            var resultTOTAL = (resultMAT + resultEMB + resultMOO + resultFF);
            console.log("CalculTotal a été appelée, le total est " + resultTOTAL); // Ajout de cette ligne
            document.getElementById("resultTOTAL").value = resultTOTAL;

        }

        //Va calculer TOTAL et MC pour obtenir le résultat dans PV
        function CalculFinal() {
            var resultTOTAL = parseInt(document.getElementById("resultTOTAL").value) || 0;
            var resultMC = parseInt(document.getElementById("resultMC").value) || 0;

            var resultPV = (resultTOTAL + resultMC);
            console.log("Le calcul final est fait, le PV est " + resultPV); // Ajout de cette ligne
            document.getElementById("resultPV").value = resultPV;
        }

        $(document).ready(function() {
            GetFF();
        });


        //On va récupérer dans la table Couf_ff pour compléter FF
        function GetFF() {
            $.ajax({
                url: '/fetch-ff',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Insérer la valeur de Cout_ff dans l'input
                    $('#resultFF').val(data.Cout_ff);
                },
                error: function(xhr, status, error) {
                    console.error("Erreur AJAX: " + status + "; " + error);
                }
            });
        }
    </script>

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

                console.log($('#resultMAT').val());
                console.log($('#resultEMB').val());
                console.log($('#resultMOD').val());
                console.log($('#resultFF').val());
                console.log($('#resultTOTAL').val());
                console.log($('#resultMC').val());
                console.log($('#resultPV').val());

                $.ajax({
                    url: '/fetch-tabledata',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        resultMAT: $('#resultMAT').val(),
                        resultEMB: $('#resultEMB').val(),
                        resultMOD: $('#resultMOD').val(),
                        resultFF: $('#resultFF').val(),
                        resultTOTAL: $('#resultTOTAL').val(),
                        resultMC: $('#resultMC').val(),
                        resultPV: $('#resultPV').val(),
                        Code_dossier: $('#Code_dossier').val(),
                    },

                    success: function(response) {
                        if (response) {
                            console.log(response);
                            alert('Données envoyées');

                            //On redirige vers la page dashboard
                            window.location.href = "/dashboard";


                        } else {
                            alert('Erreur');
                        }
                    }
                });
            });

        });
    </script>


</x-app-layout>

<script>
    window.addEventListener('load', () => {
        const loadingScreen = document.getElementById('loading');
        loadingScreen.style.display = 'none';
    });
</script>