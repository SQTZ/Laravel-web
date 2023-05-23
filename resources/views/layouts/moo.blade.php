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
                <input type="text" id="Nb_etp" class="w-24 h-8"/>
            </div>
            <div class="flex flex-col">
                <label for="CadenceHoraire" class="text-white">Cadence horaire</label>
                <input type="text" id="Cadence_horaire" class="w-24 h-8"/>
            </div>

            <div class="flex flex-col">
                <label for="CadenceHoraire" class="text-white">Taux Horaire</label>
                <input type="text" id="Taux_horaire" class="w-24 h-8 Taux_horaire" readonly/>
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
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnAjouterLigneMOD').addEventListener('click', function() {
            let formContainer = document.getElementById('formContainerMOD');
            let lastRow = formContainer.querySelector('.formRowMOD:last-child');
            let newRow = lastRow.cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = '');
            formContainer.appendChild(newRow);

        });

        document.querySelectorAll('.btnSupprimerLigne').forEach(button => {
            button.addEventListener('click', function() {
                removeRowMOD(this);
            });
        });
    });

    function removeRowMOD(button) {
        let formRow = button.closest('.formRowMOD');
        if (document.querySelectorAll('.formRowMOD').length > 1) {
            formRow.remove();
        } else {
            alert('Vous ne pouvez pas supprimer toutes les lignes !');
        }
    }
</script>

<script>
    var globalResultMOD = 0;

    function CalcReleaseMOD(formRow) {
        var nbETPMOD = parseFloat(formRow.querySelector("#Nb_etp").value);
        var CadenceHoraireMOD = parseFloat(formRow.querySelector("#Cadence_horaire").value);
        var TauxHoraireMOD = parseFloat(formRow.querySelector("#Taux_horaire").value);

        let result1 = nbETPMOD / CadenceHoraireMOD;
        let resultfinal = result1 * TauxHoraireMOD;

        return resultfinal;
    }

    function updateValuesMOD() {
        let formRows = document.querySelectorAll('.formRowMOD');
        let total = 0;

        formRows.forEach(formRow => {
            let result = CalcReleaseMOD(formRow);

            total += result;
        });

        console.log("[MOD] Total: " + total);
        document.getElementById('resultMOD').value = total;
        CalculTotal();
    }

    $(document).ready(function() {
        GetMOD();
    //dès que j'ajoute une nouvelle ligne, tu mets à jour les valeurs
    $('#btnAjouterLigneMOD').click(function() {
        GetMOD();
    });
});


//On va récupérer dans la table taux_horaire la valeur et le mettre dans #TauxHoraire sur toutes les lignes existantes
function GetMOD() {
    $.ajax({
        url: '/fetch-mod',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Insérer la valeur de taux horaire dans chaque input crée
                        $('.Taux_horaire').val(data.Taux_horaire);
        },
        error: function(xhr, status, error) {
            console.error("Erreur AJAX: " + status + "; " + error);
        }
    });
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

    console.log($('#Metier').val());
    console.log($('#Nb_etp').val());
    console.log($('#Cadence_horaire').val());
    console.log($('#Taux_horaire').val());

    $.ajax({
        url: '/fetch-moddata',
        type: 'POST',
        dataType: 'json',
        data: {
        Metier: $('#Metier').val(),
        Nb_etp: $('#Nb_etp').val(),
        Cadence_horaire: $('#Cadence_horaire').val(),
        Taux_horaire: $('#Taux_horaire').val(),
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