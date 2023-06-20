<!--Module pour la catégorie EMB-->

<div class="mb-4 bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl py-5">
    <div class="flex gap-4 mb-4 items-center ml-4">
        <h2 class="text-xl text-white">Catégorie EMB</h2>
            <button type="button" id="btnAjouterLigneEMB" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded"><i class="fa-solid fa-plus"></i></button>
    </div>

    @if(isset($dossierEMB))
    <div id="formContainerEMB">
        <form id="calcul-form" class="ml-4 gap-4 formRowEMB flex" data-rowid="1">
            <div class="flex flex-col">
                <label for="codeArticle" class="text-white">Code article</label>
                <input type="text" id="codeArticle" class="w-24 h-8" value="{{ $dossierEMB->Code_article }}">
            </div>
            <div class="flex flex-col">
                <label for="designation" class="text-white">Désignation</label>
                <input type="text" id="designation" class="h-8" value="{{ $dossierEMB->Designation }}" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="prixKg" class="text-white">Prix /kg</label>
                <input type="text" id="prixKgEMB" class="w-24 h-8" value="{{ $dossierEMB->Prix_kg }}" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="quantite" class="text-white">Quantité</label>
                <input type="text" id="quantiteEMB" class="w-24 h-8" value="{{ $dossierEMB->Quantite }}"/>
            </div>
            <div class="flex flex-col">
                <label for="freinte" class="text-white">Freinte</label>
                <input type="text" id="freinteEMB" class="w-24 h-8" value="{{ $dossierEMB->Freinte }}"/>
            </div>
            <div class="flex flex-col">
                <label for="poidsMat" class="text-white">Poids MAT</label>
                <input type="text" id="poidsMatEMB" class="w-24 h-8" value="{{ $dossierEMB->Poids_mat }}" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="coutMatiere" class="text-white">Coût matière</label>
                <input type="text" id="coutMatiereEMB" class="w-24 h-8" value="{{ $dossierEMB->Cout_matiere }}" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="freinteGlobale" class="text-white">Freinte globale</label>
                <input type="text" id="freinteGlobaleEMB" class="h-8" value="{{ $dossierEMB->Freinte_globale }}"/>
            </div>

            <button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded" onclick="removeRowEMB(this)"><i class="fa-solid fa-trash"></i></button>
        </form>
    </div>

    @else
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

            <button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded" onclick="removeRowEMB(this)"><i class="fa-solid fa-trash"></i></button>
        </form>
    </div>
    @endif
    

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
    function updateValuesEMB() {
    // obtenir toutes les lignes du formulaire
    let formRows = document.querySelectorAll('.formRowEMB');

    // initialiser le total
    let total = 0;

    // parcourir toutes les lignes du formulaire
    formRows.forEach(formRow => {
        // calculer le résultat pour cette ligne
        let result = CalcReleaseEMB(formRow);

        // ajouter le résultat au total
        total += result;
    });

    // imprimer le total dans la console
    console.log("[EMB] Total:" + total);

    // afficher le total dans l'input "resultMAT"
    document.getElementById('resultEMB').value = total;
    CalculTotal();
}

function CalcReleaseEMB(formRow) {
    var prixKgEMB = parseFloat(formRow.querySelector("#prixKgEMB").value);
    var quantiteEMB = parseFloat(formRow.querySelector("#quantiteEMB").value);
    var freinteEMB = parseFloat(formRow.querySelector("#freinteEMB").value);
    var poidsMatEMB = parseFloat(formRow.querySelector("#poidsMatEMB").value);
    var coutMatiereEMB = parseFloat(formRow.querySelector("#coutMatiereEMB").value);
    var freinteGlobaleEMB = parseFloat(formRow.querySelector("#freinteGlobaleEMB").value);

    let result = (prixKgEMB * quantiteEMB) + (freinteEMB * poidsMatEMB) + (coutMatiereEMB * freinteGlobaleEMB);

    return result;
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

    console.log($('#codeArticle').val());
    console.log($('#designation').val());
    console.log($('#prixKgEMB').val());
    console.log($('#quantiteEMB').val());
    console.log($('#freinteEMB').val());
    console.log($('#poidsMatEMB').val());
    console.log($('#coutMatiereEMB').val());
    console.log($('#freinteGlobaleEMB').val());

    $.ajax({
        url: '/fetch-embdata',
        type: 'POST',
        dataType: 'json',
        data: {
        codeArticle: $('#codeArticle').val(),
        designation: $('#designation').val(),
        prixKgEMB: $('#prixKgEMB').val(),
        quantiteEMB: $('#quantiteEMB').val(),
        freinteEMB: $('#freinteEMB').val(),
        poidsMatEMB: $('#poidsMatEMB').val(),
        coutMatiereEMB: $('#coutMatiereEMB').val(),
        freinteGlobaleEMB: $('#freinteGlobaleEMB').val(),
        Code_dossier: $('#Code_dossier').val(),
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

<script src="https://kit.fontawesome.com/0ab3d6a971.js" crossorigin="anonymous"></script>
</div>