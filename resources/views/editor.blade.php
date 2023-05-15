<x-app-layout>

<body>

</body>
<table id="resultTable" class=" w-96 text-left border-collapse">
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
        <td class="border border-gray-300 p-2"><input type="text" class="" id="resultMAT" oninput="CalculTotal()" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="" id="resultEMB" oninput="CalculTotal()" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="" id="resultMOO" oninput="CalculTotal()" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="" id="resultFF" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="" id="resultTOTAL" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="" id="resultMC"></td>
        <td class="border border-gray-300 p-2"><input type="text" class="" id="resultPV" readonly></td>
    </tr>
</tbody>


        </table>

        
        @include('layouts.mat')
        @include('layouts.emb')
        @include('layouts.moo')



        <script>
            function updateValuesTOTAL() {
    var result1 = CalcRelease1();
    var result2 = CalcRelease2();
    var result3 = CalcRelease3();

    if (result1 > 0) {
        console.log("j'ai quelque chose dans result1");
    } else {
        console.log("j'ai rien dans result1");
    }

    if (result2 > 0) {
        console.log("j'ai quelque chose dans result2");
    } else {
        console.log("j'ai rien dans result2");
    }

    if (result3 > 0) {
        console.log("j'ai quelque chose dans result3");
    } else {
        console.log("j'ai rien dans result3");
    }

    CalculTotal();  // Appeler CalculTotal() après avoir appelé CalcRelease*()
}


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