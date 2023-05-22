<!--Module pour la catégorie MOD-->
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<div class="pb-10">
    <div class="flex gap-8 mb-4 mt-24 items-center ml-4">
        <h2 class="text-xl text-white">Catégorie MOD</h2>
            <button type="button" id="btnAjouterLigneMOD" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">Ajouter</button>
    </div>

    <div id="formContainerMOD">
        <form id="calcul-form" class="ml-4 gap-4 formRowMOD flex" data-rowid="1">
            <div class="flex flex-col">
                <label for="Metier" class="text-white">Métier</label>
                <input type="text" id="Metier" class="w-24 h-8">
            </div>
            <div class="flex flex-col">
                <label for="nbETP" class="text-white">Nb ETP</label>
                <input type="text" id="nbETP" class="w-24 h-8"/>
            </div>
            <div class="flex flex-col">
                <label for="CadenceHoraire" class="text-white">Cadence horaire</label>
                <input type="text" id="CadenceHoraire" class="w-24 h-8"/>
            </div>

            <div class="flex flex-col">
                <label for="CadenceHoraire" class="text-white">Taux Horaire</label>
                <input type="text" id="TauxHoraire" class="w-24 h-8" readonly/>
            </div>

            <button type="button" id="btnSupprimerLigne" class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded" onclick="removeRowMOD(this)">Supprimer</button>
        </form>
    </div>
    <button type="button" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4" onclick="updateValuesMOD()">Calculer MOD</button>

    <style>
        form input {
            width: 150px;
        }
    </style>


<script>
    function removeRowMOD(btn) {
        let formRow = btn.closest('.formRowMOD');
        let formRowCount = document.querySelectorAll('.formRowMOD').length;

        if (formRowCount > 1) {
            formRow.remove();
        } else {
            alert('Vous ne pouvez pas supprimer toutes les lignes !');
        }
    }

    document.querySelectorAll('.formRowMOD button').forEach(button => {
        button.addEventListener('click', function() {
            removeRowMOD(this);
        });
    });

    document.addEventListener('DOMContentLoaded', (event) => {

        document.querySelectorAll('.formRowMOD').forEach(formRow => {
            attachEventListeners(formRow);
        });

        document.getElementById('btnAjouterLigneMOD').addEventListener('click', function() {
            addNewFormMOD();
        });

        function addNewFormMOD() {
            let formContainer = document.getElementById('formContainerMOD');
            let lastRow = formContainer.querySelector('.formRowMOD:last-child');
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

        
    });
</script>

<script>
    var globalResultMOD = 0;

    function CalcReleaseMOD() {
        var nbETPMOD = document.getElementById('nbETP').value;
        var CadenceHoraireMOD = document.getElementById('CadenceHoraire').value;
        var TauxHoraireMOD = document.getElementById('TauxHoraire').value;

        result1 = nbETPMOD / CadenceHoraireMOD;
        resultfinal = result1 * TauxHoraireMOD;
        document.getElementById('resultMOD').value = resultfinal;
        CalculTotal();

        return resultfinal;
    }

    function updateValuesMOD() {
        var result = CalcReleaseMOD();

        if (result > 0) {
            console.log("[MOD] Result:" + result);
        } else {
            console.log("[ERROR] Aucune donnée trouve pour MOD");
        }
    }

    $(document).ready(function() {
    GetMOD();
});


//On va récupérer dans la table Couf_ff pour compléter FF
function GetMOD() {
    $.ajax({
        url: '/fetch-mod',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Insérer la valeur de Cout_ff dans l'input
            $('#TauxHoraire').val(data.Taux_horaire);
        },
        error: function(xhr, status, error) {
            console.error("Erreur AJAX: " + status + "; " + error);
        }
    });
}
</script>
</div>