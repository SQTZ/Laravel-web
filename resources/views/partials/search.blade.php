<form action="/search" method="get">
    @csrf {{-- Inclure le jeton CSRF pour protéger le formulaire --}}
    <input type="text" name="search" placeholder="Rechercher..." value="{{ $search_text ?? '' }}" class="h-6">
    <button type="submit" class="px-2 bg-red-500 text-white">Rechercher</button>
</form>
