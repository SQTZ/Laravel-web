<!--Module pour la catégorie MAT-->

<div class="mb-4">
    
        <div class="flex justify-between items-center">
        <h2 class="text-xl mb-2 text-white">Catégorie MAT</h2>
<div class="flex gap-4">
<button type="button" id="btnAjouterLigneMAT" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ajouter</button>
</div>
        </div>

        <div id="formContainer1">
<form id="calcul-form" class="justify-around formRow1 flex" data-rowid="1">
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
    <input type="text" id="prixKg2" readonly/>
</div>

    <div class="flex flex-col">
        <label for="quantite" class="text-white">Quantité</label>
    <input type="text" id="quantite2" />
    </div>

    <div class="flex flex-col">
    <label for="freinte" class="text-white">Freinte</label>
    <input type="text" id="freinte2" />
    </div>

    <div class="flex flex-col">
    <label for="poidsMat" class="text-white">Poids MAT</label>
    <input type="text" id="poidsMat2" readonly/>
    </div>

    <div class="flex flex-col">
    <label for="coutMatiere" class="text-white">Coût matière</label>
    <input type="text" id="coutMatiere2" readonly/>
    </div>

    <div class="flex flex-col">
    <label for="freinteGlobale" class="text-white">Freinte globale</label>
    <input type="text" id="freinteGlobale2" />
    </div>
    
    <button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="removeRow1(this)">Supprimer</button>
</form>
</div>
<button type="button" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="updateValues1()">Calculer MAT</button>

<style>
    form input {
        width: 150px;
    }
</style>


<script>
function removeRow1(btn) {
        let formRow = btn.closest('.formRow1');
        let formRowCount = document.querySelectorAll('.formRow1').length;
      
        if (formRowCount > 1) {
          formRow.remove();
        } else {
          alert('Vous ne pouvez pas supprimer toutes les lignes !');
        }
    }

        // Attachez l'événement onclick aux boutons existants et futurs
        document.querySelectorAll('.formRow1 button').forEach(button => {
        button.addEventListener('click', function() {
            removeRow1(this);
        });
    });

document.addEventListener('DOMContentLoaded', (event) => {
    // Attachez les écouteurs d'événements à tous les formulaires existants
    document.querySelectorAll('.formRow1').forEach(formRow => {
        attachEventListeners(formRow);
    });

    // Ajoutez un nouveau formulaire lorsque le bouton est cliqué
    document.getElementById('btnAjouterLigneMAT').addEventListener('click', function() {
        addNewForm1();
    });
    
    function addNewForm1() {
        let formContainer = document.getElementById('formContainer1');
        let lastRow = formContainer.querySelector('.formRow1:last-child');
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
                        formRow.querySelector('#prixKg2').value = data.Prix_article_kg;
                        formRow.querySelector('#poidsMat2').value = data.Poids_MAT;
                        formRow.querySelector('#coutMatiere2').value = data.Cout_Matiere;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
    
        });
    }
});

</script>


<!--FIXME: CODE FONCTIONNELLE, A PATCHER AVEC LE FORMULAIRE PRECEDENT-->
<script>

    
    var globalResultMAT = 0;

    function CalcRelease2() {
        var prixKg = parseInt(document.getElementById("prixKg2").value);
        var quantite = parseInt(document.getElementById("quantite2").value);
        var freinte = parseInt(document.getElementById("freinte2").value);
        var poidsMAT = parseInt(document.getElementById("poidsMat2").value);
        var coutMatiere = parseInt(document.getElementById("coutMatiere2").value);
        var freinteGlobale = parseInt(document.getElementById("freinteGlobale2").value);

        // Je crée ma formule et je l'affiche dans l'input result
        result = (prixKg * quantite) + (freinte * poidsMAT) + (coutMatiere * freinteGlobale);
        document.getElementById("resultMAT").value = result;
        CalculTotal();  // Ajout de cette ligne

        // Renvoyer le résultat
    return result;
    }

    function updateValues1() {
    var result = CalcRelease2();

    if (result > 0) {
        console.log("j'ai quelque chose MAT");
    } else {
        console.log("j'ai rien MAT");
    }

}

</script>










