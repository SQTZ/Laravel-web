<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex">
            <p><a class="text-white" href="../dashboard">Retour</a></p>
            </div>


        <!--Barre de navigation-->
        @include('partials.search')



        <a class="bg-red-500 px-3 py-1 rounded-lg text-white" href="#">Créer</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1>Code dossier : {{ $Code_dossier }}</h1>
                
                <div class="flex gap-4">
                @foreach($uniqueVersions as $version)
    <a href="{{ route('editor.show', ['Code_dossier' => $Code_dossier, 'version' => $version]) }}" class="hover:text-blue-500 text-xl">v{{ $version }}</a>
@endforeach


                </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
