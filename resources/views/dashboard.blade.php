<x-app-layout>


    <x-slot name="header">
    @vite('resources/css/app.css')
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>


        <!--Barre de navigation-->
        @include('partials.search')




        <a class="border-2 border-blue-500 text-blue-500 px-4 py-1 rounded-lg hover:bg-blue-500 hover:text-white duration-150" href="editor">Créer</a>
        </div>
    </x-slot>

    <h1 class="text-white">CRUD A REGARDER: https://www.youtube.com/watch?v=_LA9QsgJ0bw</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg shadow-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <table class="table-auto w-full">
  <thead>
    <tr>
      <th class="border px-4 py-2" scope="col">Code_dossier</th>
      <th class="border px-4 py-2" scope="col">MAT</th>
      <th class="border px-4 py-2" scope="col">EMB</th>
      <th class="border px-4 py-2" scope="col">MOD</th>
      <th class="border px-4 py-2" scope="col">FF</th>
      <th class="border px-4 py-2" scope="col">MC</th>
      <th class="border px-4 py-2" scope="col">PV</th>
      <th class="border px-4 py-2" scope="col">Version(s)</th>
      <th class="border px-4 py-2" scope="col">Date</th>
      <th class="border px-4 py-2" scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>


    @foreach($articles as $article)
    <tr>


      <td class="border px-4 py-2 w-20">{{ $article->Code_dossier }}</td>
      <td class="border px-4 py-2 w-3">{{ $article->MAT }}</td>
      <td class="border px-4 py-2 w-3">{{ $article->EMB }}</td>
      <td class="border px-4 py-2 w-3">{{ $article->MOD }}</td>
      <td class="border px-4 py-2 w-3">{{ $article->FF }}</td>
      <td class="border px-4 py-2 w-3">{{ $article->MC }}</td>
      <td class="border px-4 py-2 w-3">{{ $article->PV }}</td>
      <td class="border px-4 py-2 w-3">v.{{ $article->Version }}</td>
      <td class="border px-4 py-2 w-48">{{ $article->updated_at }}</td>
      <td class="border px-4 py-2 w-3">
        <div class="flex justify-around">
        <a class="bg-blue-500 p-2 rounded-lg" href="{{ url("show/{$article->Code_dossier}") }}"><i class="fa-regular fa-eye"></i></a>
        <form action="{{ url("delete/{$article->Code_dossier}") }}" method="POST">
          @csrf
          <button type="submit" class="bg-red-500 p-2 rounded-lg"><i class="fa-solid fa-trash"></i></button>
        </form>
        </div>
      </td>



    </tr>
    @endforeach
  </tbody>
</table>


{{ $articles->links('partials.custom-pagination') }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://kit.fontawesome.com/0ab3d6a971.js" crossorigin="anonymous"></script>
