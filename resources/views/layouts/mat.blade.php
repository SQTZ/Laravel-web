<!--Module pour la catégorie MAT-->
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<div class="mb-4">
    <div class="flex gap-8 items-center mb-4 ml-4">
    <h2 class="text-xl text-white">Catégorie MAT</h2>
            <button type="button" id="btnAjouterLigneMAT" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">Ajouter</button>
    </div>

    @if(isset($dossierMAT))
    <div id="formContainerMAT">
        <form id="calcul-form" class="ml-4 gap-4 formRowMAT flex" data-rowid="1">
            <div class="flex flex-col">
                <label for="codeArticle" class="text-white">Code article</label>
                <input type="text" id="codeArticle" class="w-24 h-8" value="{{ $dossierMAT->Code_article }}">
            </div>
            <div class="flex flex-col">
                <label for="designation" class="text-white">Désignation</label>
                <input type="text" id="designation" class="h-8" value="{{ $dossierMAT->Designation }}" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="prixKg" class="text-white">Prix /kg</label>
                <input type="text" id="prixKgMAT" class="w-24 h-8" value="{{ $dossierMAT->Prix_kg }}" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="quantite" class="text-white">Quantité</label>
                <input type="text" id="quantiteMAT" class="w-24 h-8" value="{{ $dossierMAT->Quantite }}"/>
            </div>
            <div class="flex flex-col">
                <label for="freinte" class="text-white">Freinte</label>
                <input type="text" id="freinteMAT" class="w-24 h-8" value="{{ $dossierMAT->Freinte }}"/>
            </div>
            <div class="flex flex-col">
                <label for="poidsMat" class="text-white">Poids MAT</label>
                <input type="text" id="poidsMatMAT" class="w-24 h-8" value="{{ $dossierMAT->Poids_mat }}" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="coutMatiere" class="text-white">Coût matière</label>
                <input type="text" id="coutMatiereMAT" class="w-24 h-8" value="{{ $dossierMAT->Cout_matiere }}" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="freinteGlobale" class="text-white">Freinte globale</label>
                <input type="text" id="freinteGlobaleMAT" class="h-8" value="{{ $dossierMAT->Freinte_globale }}"/>
            </div>

            <button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded" onclick="removeRowMAT(this)">Supprimer</button>
        </form>
    </div>

    @else
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
    @endif
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

function updateValuesMAT() {
    // obtenir toutes les lignes du formulaire
    let formRows = document.querySelectorAll('.formRowMAT');

    // initialiser le total
    let total = 0;

    // parcourir toutes les lignes du formulaire
    formRows.forEach(formRow => {
        // calculer le résultat pour cette ligne
        let result = CalcReleaseMAT(formRow);

        // ajouter le résultat au total
        total += result;
    });

    // imprimer le total dans la console
    console.log("[MAT] Total:" + total);

    // afficher le total dans l'input "resultMAT"
    document.getElementById('resultMAT').value = total;
    CalculTotal();
}

function CalcReleaseMAT(formRow) {
    var prixKgMAT = parseFloat(formRow.querySelector("#prixKgMAT").value);
    var quantiteMAT = parseFloat(formRow.querySelector("#quantiteMAT").value);
    var freinteMAT = parseFloat(formRow.querySelector("#freinteMAT").value);
    var poidsMatMAT = parseFloat(formRow.querySelector("#poidsMatMAT").value);
    var coutMatiereMAT = parseFloat(formRow.querySelector("#coutMatiereMAT").value);
    var freinteGlobaleMAT = parseFloat(formRow.querySelector("#freinteGlobaleMAT").value);

    let result = (prixKgMAT * quantiteMAT) + (freinteMAT * poidsMatMAT) + (coutMatiereMAT * freinteGlobaleMAT);

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
    console.log($('#prixKgMAT').val());
    console.log($('#quantiteMAT').val());
    console.log($('#freinteMAT').val());
    console.log($('#poidsMatMAT').val());
    console.log($('#coutMatiereMAT').val());
    console.log($('#freinteGlobaleMAT').val());

    $.ajax({
        url: '/fetch-matdata',
        type: 'POST',
        dataType: 'json',
        data: {
        codeArticle: $('#codeArticle').val(),
        designation: $('#designation').val(),
        prixKgMAT: $('#prixKgMAT').val(),
        quantiteMAT: $('#quantiteMAT').val(),
        freinteMAT: $('#freinteMAT').val(),
        poidsMatMAT: $('#poidsMatMAT').val(),
        coutMatiereMAT: $('#coutMatiereMAT').val(),
        freinteGlobaleMAT: $('#freinteGlobaleMAT').val(),
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
</div>