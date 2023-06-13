<form action="/search" method="get" class="flex items-center mb-0">
    @csrf {{-- Inclure le jeton CSRF pour protéger le formulaire --}}
    <input type="text" name="search" placeholder="Rechercher..." value="{{ $search_text ?? '' }}" class="h-10 px-4 bg-gray-700 text-gray-300 focus:outline-none rounded-l-md border-2 border-blue-500">
    <button type="submit" class="h-10 px-4 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 focus:outline-none">
        <span class="flex items-center">
        <i class="fa-solid fa-magnifying-glass"></i>
        </span>
    </button>
</form>
