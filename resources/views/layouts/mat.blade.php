<!--Module pour la catégorie MAT-->

<div class="mb-4">
    <div class="flex gap-8 items-center mb-10 ml-4">
    <h2 class="text-xl mb-2 text-white">Catégorie MAT</h2>
            <button type="button" id="btnAjouterLigneMAT" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">Ajouter</button>
    </div>

    <div id="formContainerMAT">
        <form id="calcul-form" class="ml-4 gap-4 formRowMAT flex" data-rowid="1">
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
                <input type="text" id="prixKgMAT" class="w-24 h-8" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="quantite" class="text-white">Quantité</label>
                <input type="text" id="quantiteMAT" class="w-24 h-8"/>
            </div>
            <div class="flex flex-col">
                <label for="freinte" class="text-white">Freinte</label>
                <input type="text" id="freinteMAT" class="w-24 h-8"/>
            </div>
            <div class="flex flex-col">
                <label for="poidsMat" class="text-white">Poids MAT</label>
                <input type="text" id="poidsMatMAT" class="w-24 h-8" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="coutMatiere" class="text-white">Coût matière</label>
                <input type="text" id="coutMatiereMAT" class="w-24 h-8" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="freinteGlobale" class="text-white">Freinte globale</label>
                <input type="text" id="freinteGlobaleMAT" class="h-8"/>
            </div>

            <button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded" onclick="removeRowMAT(this)">Supprimer</button>
        </form>
    </div>
    <button type="button" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4" onclick="updateValuesMAT()">Calculer MAT</button>

    <style>
        form input {
            width: 150px;
        }
    </style>


<script>
    function removeRowMAT(btn) {
        let formRow = btn.closest('.formRowMAT');
        let formRowCount = document.querySelectorAll('.formRowMAT').length;

        if (formRowCount > 1) {
            formRow.remove();
        } else {
            alert('Vous ne pouvez pas supprimer toutes les lignes !');
        }
    }

    document.querySelectorAll('.formRowMAT button').forEach(button => {
        button.addEventListener('click', function() {
            removeRowMAT(this);
        });
    });
    
    document.addEventListener('DOMContentLoaded', (event) => {

        document.querySelectorAll('.formRowMAT').forEach(formRow => {
            attachEventListeners(formRow);
        });

        document.getElementById('btnAjouterLigneMAT').addEventListener('click', function() {
        addNewFormMAT();
    });

    function addNewFormMAT() {
        let formContainer = document.getElementById('formContainerMAT');
        let lastRow = formContainer.querySelector('.formRowMAT:last-child');
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
        formRow.querySelector('#codeArticle').addEventListener('change', function() {
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
                        formRow.querySelector('#prixKgMAT').value = data.Prix_article_kg;
                        formRow.querySelector('#poidsMatMAT').value = data.Poids_MAT;
                        formRow.querySelector('#coutMatiereMAT').value = data.Cout_Matiere;
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
    var globalResultMAT = 0;

    function CalcReleaseMAT() {
        var prixKgMAT = document.getElementById("prixKgMAT").value;
        var quantiteMAT = document.getElementById("quantiteMAT").value;
        var freinteMAT = document.getElementById("freinteMAT").value;
        var poidsMatMAT = document.getElementById("poidsMatMAT").value;
        var coutMatiereMAT = document.getElementById("coutMatiereMAT").value;
        var freinteGlobaleMAT = document.getElementById("freinteGlobaleMAT").value;

        result = (prixKgMAT * quantiteMAT) + (freinteMAT * poidsMatMAT) + (coutMatiereMAT * freinteGlobaleMAT);
        document.getElementById('resultMAT').value = result;
        CalculTotal();

        return result;
    }

    function updateValuesMAT() {
        var result = CalcReleaseMAT();

        if (result > 0) {
            console.log("[MAT] Result:" + result);
        } else {
            console.log("[ERROR] Aucune donnée trouvé pour MAT");
        }
    }
</script>
</div>