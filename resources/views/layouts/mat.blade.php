<!--Module pour la catégorie MAT-->
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<div class="mb-4 bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl py-5 mx-10">
    <div class="flex gap-4 items-center mb-4 ml-4 ">
    <h2 class="text-xl text-white">Catégorie MAT</h2>
            <button type="button" id="btnAjouterLigneMAT" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded"><i class="fa-solid fa-plus"></i></button>
            <div id="progressQuantiteMAT" class="text-white"></div>
    </div>



    @if(isset($dossierMAT))
    <div id="formContainerMAT">
    @foreach($dossierMAT as $mat)
        <form id="calcul-form" class="ml-4 gap-4 formRowMAT flex" data-rowid="1">
            <div class="flex flex-col">
                <label for="codeArticle" class="text-white">Code article</label>
                <input type="text" id="codeArticle" class="codeArticle w-24 h-8" value="{{ $mat->Code_article }}">
            </div>
            <div class="flex flex-col">
                <label for="designation" class="text-white">Désignation</label>
                <input type="text" id="designation" class="designation h-8" value="{{ $mat->Designation }}" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="prixKg" class="text-white">Prix /kg</label>
                <input type="text" id="prixKgMAT" class="prixKgMAT w-24 h-8" value="{{ $mat->Prix_kg }}" oninput="calculerCoutMatiereMAT()" readonly/>
            </div>
            <div class="flex flex-col">
                <div id="progressTextMAT" class="text-white"></div>
                <label for="quantite" class="text-white">Quantité</label>
                <input type="text" id="quantiteMAT" class="quantiteMAT w-24 h-8" value="{{ $mat->Quantite }}" oninput="calculerCoutMatiereMAT()"/>
            </div>
            <div class="flex flex-col">
                <label for="coutMatiere" class="text-white">Coût matière</label>
                <input type="text" id="coutMatiereMAT" class="coutMatiereMAT w-24 h-8" value="{{ $mat->Cout_matiere }}" oninput="calculerFreinteMAT()" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="freinte" class="text-white">Freinte</label>
                <input type="text" id="freinteMAT" class="freinteMAT w-24 h-8" value="{{ $mat->Freinte }}" oninput="calculerFreinteMAT()"/>
            </div>
            <div class="flex flex-col">
                <label for="poidsMat" class="text-white">Poids MAT</label>
                <input type="text" id="poidsMatMAT" class="poidsMatMAT w-24 h-8" value="{{ $mat->Poids_mat }}" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="freinteGlobale" class="text-white">Total</label>
                <input type="text" id="freinteGlobaleMAT" class="freinteGlobaleMAT h-8" value="{{ $mat->Freinte_globale }}"/>
            </div>

            <button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded" onclick="removeRowMAT(this)"><i class="fa-solid fa-trash"></i></button>
        </form>
        @endforeach
    </div>

    @else
    <div id="formContainerMAT">
        <form id="calcul-form" class="ml-4 gap-4 formRowMAT flex" data-rowid="1">
            <div class="flex flex-col">
                <label for="codeArticle" class="text-white">Code article</label>
                <input type="text" id="codeArticle" class="codeArticle w-24 h-8">
            </div>
            <div class="flex flex-col">
                <label for="designation" class="text-white">Désignation</label>
                <input type="text" id="designation" class="designation h-8" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="prixKg" class="text-white">Prix /kg</label>
                <input type="text" id="prixKgMAT" class="prixKgMAT w-24 h-8" oninput="calculerCoutMatiereMAT()" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="quantite" class="text-white">Quantité</label>
                <input type="text" id="quantiteMAT" class="quantiteMAT w-24 h-8" oninput="calculerCoutMatiereMAT()"/>
            </div>
            <div class="flex flex-col">
                <label for="coutMatiere" class="text-white">Coût matière</label>
                <input type="text" id="coutMatiereMAT" class="coutMatiereMAT w-24 h-8" oninput="calculerFreinteMAT()" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="freinte" class="text-white">Freinte</label>
                <input type="text" id="freinteMAT" class="freinteMAT w-24 h-8" oninput="calculerFreinteMAT()"/>
            </div>
            <div class="flex flex-col">
                <label for="poidsMat" class="text-white">Poids MAT</label>
                <input type="text" id="poidsMatMAT" class="poidsMatMAT w-24 h-8" readonly/>
            </div>
            <div class="flex flex-col">
                <label for="freinteGlobale" class="text-white">Total</label>
                <input type="text" id="freinteGlobaleMAT" class="freinteGlobaleMAT h-8"/>
            </div>

            <button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded" onclick="removeRowMAT(this)"><i class="fa-solid fa-trash"></i></button>
        </form>
    </div>
    @endif
    

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
            //alert('Vous ne pouvez pas supprimer toutes les lignes !');
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
                        //formRow.querySelector('#coutMatiereMAT').value = data.Cout_Matiere;
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

function calculerCoutMatiereMAT() {
    var prixKgElements = document.getElementsByClassName('prixKgMAT');
    var quantiteElements = document.getElementsByClassName('quantiteMAT');
    var coutMatiereElements = document.getElementsByClassName('coutMatiereMAT');
    var totalQuantite = 0;

    for (var i = 0; i < prixKgElements.length; i++) {
        var prixKg = parseFloat(prixKgElements[i].value);
        var quantite = parseFloat(quantiteElements[i].value);

        // Verify if adding the current quantity would exceed 1
        if (totalQuantite + quantite > 1) {
            alert("La somme des quantités ne peut pas dépasser 1");
            quantiteElements[i].value = (1 - totalQuantite).toFixed(2); // set the value so that total becomes 1
            quantite = 1 - totalQuantite; // update the quantity to be added
        }

        var coutMatiere = prixKg * quantite;
        coutMatiereElements[i].value = coutMatiere.toFixed(2);

        // Add the current quantity to the total
        totalQuantite += quantite;
    }

    // Update the progress text
    var progressText = document.getElementById('progressQuantiteMAT');
    progressText.innerText = "Quantité: " + (totalQuantite * 100).toFixed(2) + "%";

    // Check if the total quantity is 1
    if (totalQuantite.toFixed(2) == 1.00) {
        alert("La somme des quantités est égale à 1");
    }
}




    function calculerFreinteMAT() {
      var FreinteElements = document.getElementsByClassName('freinteMAT');
      var coutMatiereElements = document.getElementsByClassName('coutMatiereMAT');
      var freinteglobaleElements = document.getElementsByClassName('freinteGlobaleMAT');

      for (var i = 0; i < FreinteElements.length; i++) {
        var freinte = parseFloat(FreinteElements[i].value);
        var coutMatiere = parseFloat(coutMatiereElements[i].value);
        var freinteGlobale = freinte + coutMatiere;

        freinteglobaleElements[i].value = freinteGlobale.toFixed(2);
      }
    }



function CalcReleaseMAT(formRow) {
    var prixKgMAT = parseFloat(formRow.querySelector("#prixKgMAT").value);
    var quantiteMAT = parseFloat(formRow.querySelector("#quantiteMAT").value);
    var freinteMAT = parseFloat(formRow.querySelector("#freinteMAT").value);
    var poidsMatMAT = parseFloat(formRow.querySelector("#poidsMatMAT").value);
    var coutMatiereMAT = parseFloat(formRow.querySelector("#coutMatiereMAT").value);
    var freinteGlobaleMAT = parseFloat(formRow.querySelector("#freinteGlobaleMAT").value);  

    let result = coutMatiereMAT;

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

    // créer un tableau pour stocker les données de tous les formulaires
    var dataArr = [];

    // pour chaque formulaire...
    $('.formRowMAT').each(function() {
        // ...créer un objet pour stocker les données de ce formulaire
        var formData = {
            codeArticle: $(this).find('.codeArticle').val(),
            designation: $(this).find('.designation').val(),
            prixKgMAT: $(this).find('.prixKgMAT').val(),
            quantiteMAT: $(this).find('.quantiteMAT').val(),
            freinteMAT: $(this).find('.freinteMAT').val(),
            poidsMatMAT: $(this).find('.poidsMatMAT').val(),
            coutMatiereMAT: $(this).find('.coutMatiereMAT').val(),
            freinteGlobaleMAT: $(this).find('.freinteGlobaleMAT').val(),
            Code_dossier: $('#Code_dossier').val(),
        };

        // ajouter cet objet au tableau
        dataArr.push(formData);
    });

    // imprimer le tableau pour le débogage
    console.log(dataArr);

    $.ajax({
    url: '/fetch-matdata',
    type: 'POST',
    dataType: 'json',
    data: {
        Code_dossier: $('#Code_dossier').val(),
        matEntries: dataArr, // envoyer le tableau complet
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