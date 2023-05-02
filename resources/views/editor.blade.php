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
    <tr>
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

        <div class="mb-4">
    
        <div class="flex justify-between items-center">
        <h2 class="text-xl mb-2 text-white">Catégorie MAT</h2>
<div class="flex gap-4">
<button type="button" id="btnAjouterLigne" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ajouter</button>
<button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</button>
</div>
        </div>

    <div id="formContainer">
    <form id="matForm" class="formRow" data-rowid="1">
        <div class="flex gap-4 justify-center" data-rowid="1">
            <div class="flex flex-col">
                <label for="codeArticle" class="text-white">Code article</label>
                <input type="text" id="codeArticle" class="w-56">
            </div>
            <div class="flex flex-col">
                <label for="designation" class="text-white">Désignation</label>
                <input type="text" id="designation" class="">
            </div>
            <div class="flex flex-col">
                <label for="prixKg" class="text-white">Prix /kg</label>
                <input type="number" id="prixKg" class="">
            </div>
            <div class="flex flex-col">
                <label for="quantite" class="text-white">Quantité</label>
                <input type="number" id="quantite" class="">
            </div>
            <div class="flex flex-col">
                <label for="freinte" class="text-white">Freinte</label>
                <input type="number" id="freinte" class="">
            </div>
            <div class="flex flex-col">
                <label for="poidsMat" class="text-white">Poids MAT</label>
                <input type="number" id="poidsMat" class="">
            </div>
            <div class="flex flex-col">
                <label for="coutMatiere" class="text-white">Coût matière</label>
                <input type="number" id="coutMatiere" class="">
            </div>
            <div class="flex flex-col">
                <label for="freinteGlobale" class="text-white">Freinte globale</label>
                <input type="number" id="freinteGlobale" class="">
            </div>
        </div>

    </form>
    </div>
    <button type="button" id="btnCalculerMat" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Calculer MAT</button>
</div>

<style>
    form input {
        width: 150px;
    }
</style>



<script>
//Script permettant d'ajouter ou supprimer une ligne de formulaire

document.getElementById('btnAjouterLigne').addEventListener('click', function() {
    let formContainer = document.getElementById('formContainer');
    let lastRow = formContainer.querySelector('.formRow:last-child');
    let lastRowId = parseInt(lastRow.getAttribute('data-rowid'));
    let newRowId = lastRowId + 1;

    let newRow = lastRow.cloneNode(true);
    newRow.setAttribute('data-rowid', newRowId);
    newRow.querySelectorAll('input').forEach(input => {
        input.id = input.id.replace(lastRowId, newRowId);
        input.value = ""; // Efface la valeur de l'élément input
    });

    

    formContainer.appendChild(newRow);
});

// Supprime n'importe quelle ligne
document.getElementById('btnSupprimerLigne').addEventListener('click', function() {
    let formContainer = document.getElementById('formContainer');
    let lastRow = formContainer.querySelector('.formRow:last-child');
    let lastRowId = parseInt(lastRow.getAttribute('data-rowid'));
    let newRowId = lastRowId - 1;

    if (lastRowId > 1) {
        formContainer.removeChild(lastRow);
    }
});


</script>



<script>
//Script permettant de récupérer les données situés dans la table g_produits

    function fetchDataForCodeArticle(input) {
    input.addEventListener('change', function () {
        let codeArticle = input.value;
        
        fetch(`/fetch-data?Reference=${codeArticle}`, {
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    let formRow = input.closest('.formRow');
                    formRow.querySelector('#designation').value = data.Designation;
                    formRow.querySelector('#prixKg').value = data.Prix_article_kg;
                    formRow.querySelector('#poidsMat').value = data.Poids_MAT;
                    formRow.querySelector('#coutMatiere').value = data.Cout_Matiere;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
}

// Ajoutez l'événement 'change' à tous les éléments d'entrée du code article
document.querySelectorAll('#codeArticle').forEach(fetchDataForCodeArticle);

</script>


</x-app-layout>