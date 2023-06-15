<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Supprimer mon compte') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Cette action est irréversible. Une fois que votre compte est supprimé, il ne peut pas être restauré, et vous ne pourrez plus accéder à aucune donnée ou information associée à votre compte.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Supprimer') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Êtes vous sur ?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Cette action est irréversible. Une fois que votre compte est supprimé, il ne peut pas être restauré, et vous ne pourrez plus accéder à aucune donnée ou information associée à votre compte. Si vous comprenez les conséquences de cette action et souhaitez toujours supprimer votre compte, veuillez confirmer votre décision. Autrement, si vous souhaitez conserver votre compte, vous pouvez simplement fermer cette page ou naviguer ailleurs sur notre site. Nous vous recommandons de sauvegarder toutes les informations ou données importantes avant de procéder à la suppression de votre compte.Nous ne serons pas en mesure de récupérer ou de fournir aucune information après que le compte a été supprimé.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="h-10 px-4 bg-gray-700 text-gray-300 focus:outline-none rounded-md border-2 border-blue-500 w-full"
                    placeholder="{{ __('Mot de passe') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Supprimer définitivement') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
