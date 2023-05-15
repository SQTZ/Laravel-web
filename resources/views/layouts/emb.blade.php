<!--Module pour la catégorie EMB-->

<div class="mb-4">
    <div class="flex gap-8 mb-4 mt-24 items-center ml-4">
        <h2 class="text-xl text-white">Catégorie EMB</h2>
            <button type="button" id="btnAjouterLigneEMB" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">Ajouter</button>
    </div>

    <div id="formContainerEMB">
        <form id="calcul-form" class="ml-4 gap-4 formRowEMB flex" data-rowid="1">
            <div class="flex flex-col">
                <label for="codeArticle" class="text-white">Code article</label>
                <input type="text" id="codeArticle" class="w-24 h-8">
            </div>
            <div class="flex flex-col">
                <label for="designation" class="text-white">Désignation</label>
                <input type="text" id="designation" class="h-8" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="prixKg" class="text-white">Prix /kg</label>
                <input type="text" id="prixKgEMB" class="w-24 h-8" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="quantite" class="text-white">Quantité</label>
                <input type="text" id="quantiteEMB" class="w-24 h-8"/>
            </div>
            <div class="flex flex-col">
                <label for="freinte" class="text-white">Freinte</label>
                <input type="text" id="freinteEMB" class="w-24 h-8"/>
            </div>
            <div class="flex flex-col">
                <label for="poidsMat" class="text-white">Poids MAT</label>
                <input type="text" id="poidsMatEMB" class="w-24 h-8" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="coutMatiere" class="text-white">Coût matière</label>
                <input type="text" id="coutMatiereEMB" class="w-24 h-8" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="freinteGlobale" class="text-white">Freinte globale</label>
                <input type="text" id="freinteGlobaleEMB" class="h-8"/>
            </div>

            <button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded" onclick="removeRowEMB(this)">Supprimer</button>
        </form>
    </div>
    <button type="button" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4" onclick="updateValuesEMB()">Calculer EMB</button>

    <style>
        form input {
            width: 150px;
        }
    </style>


<script>
    function removeRowEMB(btn) {
        let formRow = btn.closest('.formRowEMB');
        let formRowCount = document.querySelectorAll('.formRowEMB').length;

        if (formRowCount > 1) {
            formRow.remove();
        } else {
            alert('Vous ne pouvez pas supprimer toutes les lignes !');
        }
    }

    document.querySelectorAll('.formRowEMB button').forEach(button => {
        button.addEventListener('click', function() {
            removeRowEMB(this);
        });
    });

    document.addEventListener('DOMContentLoaded', (event) => {

        document.querySelectorAll('.formRowEMB').forEach(formRow => {
            attachEventListeners(formRow);
        });

        document.getElementById('btnAjouterLigneEMB').addEventListener('click', function() {
            addNewFormEMB();
        });

        function addNewFormEMB() {
            let formContainer = document.getElementById('formContainerEMB');
            let lastRow = formContainer.querySelector('.formRowEMB:last-child');
            let lastRowId = parseInt(lastRow.getAttribute('data-rowid'));
            let newRowId = lastRowId + 1;

            let newRow = lastRow.cloneNode(true);
            newRow.setAttribute('data-rowid', newRowId);
            newRow.querySelectorAll('input').forEach(input => {
                input.id = input.id.replace(lastRowId, newRowId);
                input.value = '';
            });

            formContainer.appendChild(newRow);
            attachEventListeners(newRow);
        }

        function attachEventListeners(formRow) {
            formRow.querySelector('#codeArticle').addEventListener('change', function () {
                let codeArticle = this.value;

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
                            formRow.querySelector('#designation').value = data.Designation;
                            formRow.querySelector('#prixKgEMB').value = data.Prix_article_kg;
                            formRow.querySelector('#poidsMatEMB').value = data.Poids_MAT;
                            formRow.querySelector('#coutMatiereEMB').value = data.Cout_Matiere;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        }
    });
</script>

<script>
    var globalResultEMB = 0;

    function CalcReleaseEMB() {
        var prixKgEMB = document.getElementById('prixKgEMB').value;
        var quantiteEMB = document.getElementById('quantiteEMB').value;
        var freinteEMB = document.getElementById('freinteEMB').value;
        var poidsMatEMB = document.getElementById('poidsMatEMB').value;
        var coutMatiereEMB = document.getElementById('coutMatiereEMB').value;
        var freinteGlobaleEMB = document.getElementById('freinteGlobaleEMB').value;

        result = (prixKgEMB * quantiteEMB) + (freinteEMB * poidsMatEMB) + (freinteGlobaleEMB * coutMatiereEMB);
        document.getElementById('resultEMB').value = result;
        CalculTotal();

        return result;
    }

    function updateValuesEMB() {
        var result = CalcReleaseEMB();

        if (result > 0) {
            console.log("[EMB] Result: " + result);
        } else {
            console.log("[ERROR] Aucune donnée trouvé pour EMB");
        }
    }
</script>
</div>