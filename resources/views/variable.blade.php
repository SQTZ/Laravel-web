<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<x-app-layout>
        <h1 class="text-4xl text-white ml-4 mt-10 py-1">Variables</h1>
        <h2 class="ml-4 text-white text-lg">Ici, vous devrez inscrire vos variables si vous voulez que vos calculs ne soient pas faussés ou corrompus.</h2>
        <p class="text-white ml-4">Un souci ? Regardez la <a href="/" class="text-blue-500 hover:underline">Documentation</a>.</p>

        <div class="flex gap-10 justify-center items-center mt-10">
            <div class="flex flex-col">
                <h3 class="text-xl text-white">Taux Horaire</h3>
                <input type="text" id="TauxHoraire" class="h-8">
                <p class="text-gray-500">TH Actuel: N/A</p>
            </div>
            <div class="flex flex-col">
                <h3 class="text-xl text-white">Coût FF</h3>
                <input type="text" id="CoutFF" class="h-8">
                <p class="text-gray-500">FF Actuel: N/A</p>
            </div>
            <div class="flex flex-col">
                <h3 class="text-xl text-white">Coût Bobine</h3>
                <input type="text" id="CoutBobine" class="h-8">
                <p class="text-gray-500">Coût Actuel: N/A</p>
            </div>

            <div>
            <button type="button" id="btnPush" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ajouter</button>
            </div>
        </div>

</x-app-layout>

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

    console.log($('#TauxHoraire').val());
    console.log($('#CoutFF').val());
    console.log($('#CoutBobine').val());

    $.ajax({
        url: '/fetch-variable',
        type: 'POST',
        dataType: 'json',
        data: {
            Taux_horaire: $('#TauxHoraire').val(),
            Cout_ff: $('#CoutFF').val(),
            Cout_bobine: $('#CoutBobine').val()
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