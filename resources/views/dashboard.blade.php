<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>


        <!--Barre de navigation-->
        @include('partials.search')




        <a class="bg-red-500 px-3 py-1 rounded-lg text-white" href="editor">Créer</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1>Liste des produits</h1>
                <table class="table-auto w-full">
  <thead>
    <tr>
      <th class="border px-4 py-2" scope="col">Code_article</th>
      <th class="border px-4 py-2" scope="col">MAT</th>
      <th class="border px-4 py-2" scope="col">EMB</th>
      <th class="border px-4 py-2" scope="col">MOD</th>
      <th class="border px-4 py-2" scope="col">FF</th>
      <th class="border px-4 py-2" scope="col">MC</th>
      <th class="border px-4 py-2" scope="col">PV</th>
      <th class="border px-4 py-2" scope="col">Version</th>
      <th class="border px-4 py-2" scope="col">Date</th>
      <th class="border px-4 py-2" scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($articles as $article)
    <tr>
      <td class="border px-4 py-2">{{ $article->Code_article }}</td>
      <td class="border px-4 py-2">{{ $article->MAT }}</td>
      <td class="border px-4 py-2">{{ $article->EMB }}</td>
      <td class="border px-4 py-2">{{ $article->MOD }}</td>
      <td class="border px-4 py-2">{{ $article->FF }}</td>
      <td class="border px-4 py-2">{{ $article->MC }}</td>
      <td class="border px-4 py-2">{{ $article->PV }}</td>
      <td class="border px-4 py-2">{{ $article->Version }}</td>
      <td class="border px-4 py-2">{{ $article->Date }}</td>
      <td class="border px-4 py-2">
        <a href="{{ url("show/{$article->Code_article}") }}">Visualiser</a>
        <a href="{{ url("edit/{$article->Code_article}") }}">Modifier</a>
        <form action="{{ url("delete/{$article->Code_article}") }}" method="POST">
          @csrf
          <button type="submit">Supprimer</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
