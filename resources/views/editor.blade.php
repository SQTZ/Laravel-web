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
        <td class="border border-gray-300 p-2"><input type="text" class="" id="resultMAT" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="" id="resultEMB" readonly></td>
        <td class="border border-gray-300 p-2"><input type="text" class="" id="resultMOO" readonly></td>
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


</x-app-layout>

<script>
//  Je crée une fonction qui, dès que la valeur passe à 1 pour MAT; EMB; MOO; FF; on va calculer le résultat
//  qui sera inscrit dans TOTAL, puis on écrit la valeur souhaité dans MC puis enfin calculer TOTAL et MC pour obtenir PV.


</script>