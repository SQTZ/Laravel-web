<x-app-layout>

<body>

</body>
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
        <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultTOTAL" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultMC"></td>
        <td class="border border-gray-300 p-2"><input type="text" class="w-24 h-8" id="resultPV" readonly></td>
    </tr>
</tbody>


        </table>

        <!--J'inclus mes layouts MAT, EMB, MOO et FF pour activer le mode calcul-->
        @include('layouts.mat')
        @include('layouts.emb')
        @include('layouts.moo')



        <script>

            //Fait le calcul
            function CalculTotal() {
    var resultMAT = parseInt(document.getElementById("resultMAT").value) || 0;
    var resultEMB = parseInt(document.getElementById("resultEMB").value) || 0;
    var resultMOO = parseInt(document.getElementById("resultMOO").value) || 0;

    // Je crée ma formule et je l'affiche dans l'input result
    var resultTOTAL = (resultMAT + resultEMB + resultMOO);
    console.log("CalculTotal a été appelée, le total est " + resultTOTAL);  // Ajout de cette ligne
    document.getElementById("resultTOTAL").value = resultTOTAL;
}






</script>
</x-app-layout>