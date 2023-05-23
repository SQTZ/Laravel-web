<x-app-layout>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>


<table id="resultTable" class="m-auto mt-5 mb-24">
            <thead>
                <tr>
                    <th class="border border-gray-300 p-2 text-white">MAT</th>
                    <th class="border border-gray-300 p-2 text-white">EMB</th>
                    <th class="border border-gray-300 p-2 text-white">MOO</th>
                    <th class="border border-gray-300 p-2 text-white">FF</th>
                    <th class="border border-gray-300 p-2 text-white">TOTAL</th>
                    <th class="border border-gray-300 p-2 text-white">MC</th>
                    <th class="border border-gray-300 p-2 text-white">PV</th>
                </tr>
            </thead>
            <tbody>
    <tr id="resultTD">
        <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultMAT" oninput="CalculTotal()" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultEMB" oninput="CalculTotal()" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultMOD" oninput="CalculTotal()" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultFF" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultTOTAL" oninput="CalculFinal()" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultMC" onchange="CalculFinal()"></td>
        <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultPV" readonly></td>
    </tr>
    <button id="btnPush" class="bg-yellow-700 rounded-lg px-4 py-2">Push Me!</button>
</tbody>


        </table>

        <!--J'inclus mes layouts MAT, EMB, MOO et FF pour activer le mode calcul-->
        @include('layouts.mat')
        @include('layouts.emb')
        @include('layouts.moo')

<button id="tester" class="text-white">Tester</button>

        <script>

            //Va calculer le MAT, EMB, MOD et FF pour obtenir le résultat dans TOTAL
            function CalculTotal() {
    var resultMAT = parseInt(document.getElementById("resultMAT").value) || 0;
    var resultEMB = parseInt(document.getElementById("resultEMB").value) || 0;
    var resultMOO = parseInt(document.getElementById("resultMOD").value) || 0;
    var resultFF = parseInt(document.getElementById("resultFF").value) || 0;

    // Je crée ma formule et je l'affiche dans l'input result pt.1
    var resultTOTAL = (resultMAT + resultEMB + resultMOO + resultFF);
    console.log("CalculTotal a été appelée, le total est " + resultTOTAL);  // Ajout de cette ligne
    document.getElementById("resultTOTAL").value = resultTOTAL;

}

//Va calculer TOTAL et MC pour obtenir le résultat dans PV
function CalculFinal() {
    var resultTOTAL = parseInt(document.getElementById("resultTOTAL").value) || 0;
    var resultMC = parseInt(document.getElementById("resultMC").value) || 0;
    
    var resultPV = (resultTOTAL + resultMC);
    console.log("Le calcul final est fait, le PV est " + resultPV);  // Ajout de cette ligne
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
    },

        success: function(response) {
            if (response) {
                console.log(response);
                alert('Données envoyées');

            } else {
                alert('Erreur');
            }
        }
    });
});

});



</script>


</x-app-layout>