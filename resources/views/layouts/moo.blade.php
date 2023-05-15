<!--Module pour la catégorie MOO-->

<div class="mb-4">
    
        <div class="flex justify-between items-center">
        <h2 class="text-xl mb-2 text-white">Catégorie MOO</h2>
<div class="flex gap-4">
<button type="button" id="btnAjouterLigneMOO" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ajouter</button>
</div>
        </div>

        <div id="formContainer3">
<form id="calcul-form" class="justify-around formRow3 flex" data-rowid="1">
<div class="flex flex-col">
                <label for="Metier" class="text-white">Métier</label>
                <input type="text" id="Metier" class="w-56">
            </div>
            <div class="flex flex-col">
                <label for="NbEtp" class="text-white">Nb Etp</label>
                <input type="text" id="NbEtp">
            </div>
<div class="flex flex-col">
    <label for="CadenceHoraire" class="text-white">Cadence horaire</label>
    <input type="text" id="CadenceHoraire"/>
</div>
    
    <button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="removeRow3(this)">Supprimer</button>
</form>
</div>
<button type="button" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="updateValues3()">Calculer MAT</button>

<style>
    form input {
        width: 150px;
    }
</style>


<script>
function removeRow3(btn) {
  let formRow = btn.closest('.formRow3');
  let formRowCount = document.querySelectorAll('.formRow3').length;

  if (formRowCount > 1) {
    formRow.remove();
  } else {
    alert('Vous ne pouvez pas supprimer toutes les lignes !');
  }
}

//Script permettant de récupérer les données situés dans la table g_produits

function addNewForm3() {
    let formContainer = document.getElementById('formContainer3');
    let lastRow = formContainer.querySelector('.formRow3:last-child');
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

// Attachez les écouteurs d'événements à tous les formulaires existants
document.querySelectorAll('.formRow3').forEach(formRow => {
    attachEventListeners(formRow);
});

// Ajoutez un nouveau formulaire lorsque le bouton est cliqué
document.getElementById('btnAjouterLigneMOO').addEventListener('click', function() {
    addNewForm3();
});

</script>


<!--FIXME: CODE FONCTIONNELLE, A PATCHER AVEC LE FORMULAIRE PRECEDENT-->
<script>
    var globalResultMOO = 0;

    function CalcRelease3() {
        var Metier = parseInt(document.getElementById("Metier").value);
        var NbEtp = parseInt(document.getElementById("NbEtp").value);
        var CadenceHoraire = parseInt(document.getElementById("CadenceHoraire").value);

        // Je crée ma formule et je l'affiche dans l'input result
        result = (NbEtp / CadenceHoraire);
        document.getElementById("resultMOO").value = result;
        CalculTotal();  // Ajout de cette ligne

        return result;
    }

    function updateValues3() {
    var result = CalcRelease3();

    if (result > 0) {
        console.log("j'ai quelque chose MOO");
    } else {
        console.log("j'ai rien MOO");
    }

    // ... le reste de votre code ...
}
</script>










