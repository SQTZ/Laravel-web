<!--Module pour la catégorie EMB-->

<div class="mb-4">
    
        <div class="flex justify-between items-center">
        <h2 class="text-xl mb-2 text-white">Catégorie EMB</h2>
<div class="flex gap-4">
<button type="button" id="btnAjouterLigneEMB" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ajouter</button>
</div>
        </div>

        <div id="formContainer2">
<form id="calcul-form" class="justify-around formRow2 flex" data-rowid="1">
<div class="flex flex-col">
                <label for="codeArticle" class="text-white">Code article</label>
                <input type="text" id="codeArticle" class="w-56">
            </div>
            <div class="flex flex-col">
                <label for="designation" class="text-white">Désignation</label>
                <input type="text" id="designation" readonly>
            </div>
<div class="flex flex-col">
    <label for="prixKg" class="text-white">Prix /kg</label>
    <input type="text" id="prixKg1" readonly/>
</div>

    <div class="flex flex-col">
        <label for="quantite" class="text-white">Quantité</label>
    <input type="text" id="quantite1" />
    </div>

    <div class="flex flex-col">
    <label for="freinte" class="text-white">Freinte</label>
    <input type="text" id="freinte1" />
    </div>

    <div class="flex flex-col">
    <label for="poidsMat" class="text-white">Poids MAT</label>
    <input type="text" id="poidsMat1" readonly/>
    </div>

    <div class="flex flex-col">
    <label for="coutMatiere" class="text-white">Coût matière</label>
    <input type="text" id="coutMatiere1" readonly/>
    </div>

    <div class="flex flex-col">
    <label for="freinteGlobale" class="text-white">Freinte globale</label>
    <input type="text" id="freinteGlobale1" />
    </div>
    
    <button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="removeRow2(this)">Supprimer</button>
</form>
</div>
<button type="button" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="updateValues2()">Calculer EMB</button>

<style>
    form input {
        width: 150px;
    }
</style>


<script>
function removeRow2(btn) {
  let formRow = btn.closest('.formRow2');
  let formRowCount = document.querySelectorAll('.formRow2').length;

  if (formRowCount > 1) {
    formRow.remove();
  } else {
    alert('Vous ne pouvez pas supprimer toutes les lignes !');
  }
}

//Script permettant de récupérer les données situés dans la table g_produits

function addNewForm2() {
    let formContainer = document.getElementById('formContainer2');
    let lastRow = formContainer.querySelector('.formRow2:last-child');
    let lastRowId = parseInt(lastRow.getAttribute('data-rowid'));
    let newRowId = lastRowId + 1;

    let newRow = lastRow.cloneNode(true);
    newRow.setAttribute('data-rowid', newRowId);
    newRow.querySelectorAll('input').forEach(input => {
        input.id = input.id.replace(lastRowId, newRowId);
        input.value = ""; // Efface la valeur de l'élément input
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
                    formRow.querySelector('#prixKg1').value = data.Prix_article_kg;
                    formRow.querySelector('#poidsMat1').value = data.Poids_MAT;
                    formRow.querySelector('#coutMatiere1').value = data.Cout_Matiere;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });

    });
}

// Attachez les écouteurs d'événements à tous les formulaires existants
document.querySelectorAll('.formRow2').forEach(formRow => {
    attachEventListeners(formRow);
});

// Ajoutez un nouveau formulaire lorsque le bouton est cliqué
document.getElementById('btnAjouterLigneEMB').addEventListener('click', function() {
    addNewForm2();
});

</script>


<!--FIXME: CODE FONCTIONNELLE, A PATCHER AVEC LE FORMULAIRE PRECEDENT-->
<script>
    var globalResultEMB = 0;

    function CalcRelease() {
        var prixKg = parseInt(document.getElementById("prixKg1").value);
        var quantite = parseInt(document.getElementById("quantite1").value);
        var freinte = parseInt(document.getElementById("freinte1").value);
        var poidsMAT = parseInt(document.getElementById("poidsMat1").value);
        var coutMatiere = parseInt(document.getElementById("coutMatiere1").value);
        var freinteGlobale = parseInt(document.getElementById("freinteGlobale1").value);

        // Je crée ma formule et je l'affiche dans l'input result
        result = (prixKg * quantite) + (freinte * poidsMAT) + (coutMatiere * freinteGlobale);
        document.getElementById("resultEMB").value = result;

        return result;
    }

    function updateValues2() {
    var result = CalcRelease();

    if (result > 0) {
        console.log("j'ai quelque chose EMB");
    } else {
        console.log("j'ai rien EMB");
    }

    // ... le reste de votre code ...
}
</script>










