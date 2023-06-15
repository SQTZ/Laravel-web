<x-app-layout>

    <div x-data="{ open: true }" class="flex h-full">
        <!-- Sidebar -->
        <div :class="{ 'hidden': !open, 'block': open }" class="bg-gray-800 text-white w-64 py-6 px-4">
            <h2 class="font-semibold mb-2"><a href="#introduction"><span class="text-blue-500"># </span>Introduction</a></h2>
            <h2 class=" font-semibold mb-2"><a href="#installation_et_configuration"><span class="text-blue-500"># </span>Installation & Configuration</a></h2>
            <nav>
                <a href="#prerequis" class="block py-2 px-2 rounded hover:bg-gray-700 text-gray-400 text-sm">Prérequis</a>
                <a href="#installation" class="block py-2 px-2 rounded hover:bg-gray-700 text-gray-400 text-sm">Installation</a>
                <a href="#configuration" class="block py-2 px-2 rounded hover:bg-gray-700 text-gray-400 text-sm">Configuration</a>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-1 flex flex-col">
            <!-- Hamburger button -->
            <button @click="open = !open" class="text-white py-2 px-4">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Content goes here -->
            <main class="flex-1 p-4">
                <section id="introduction" class="mb-10">
                    <h2 class="text-2xl font-semibold text-white"><span class="text-blue-500"># </span>Introduction</h2>
                    <p class="text-gray-400">Bienvenue sur Appliweb, nous sommes ravis de vous accueillir sur notre plateforme en ligne. Veuillez noter que l'application est actuellement en phase de développement. Cela signifie que certaines fonctionnalités pourraient ne pas être entièrement finalisées ou que des erreurs pourraient survenir pendant votre utilisation. Nous travaillons activement pour améliorer l'application et ajouter de nouvelles fonctionnalités passionnantes. Votre patience et votre compréhension sont grandement appréciées pendant cette période de développement.<br>N'hésitez pas à explorer les fonctionnalités actuellement disponibles et à nous faire part de vos commentaires et suggestions. Votre retour est essentiel pour nous aider à façonner et à améliorer l'application.</p>
                </section>

                <section id="installation_et_configuration" class="mb-10">
                    <h2 class="text-2xl font-semibold text-white"><span class="text-blue-500"># </span>Installation & Configuration</h2>
                    <h3 class="text-lg text-white ml-8 mt-4" id="prerequis">Prérequis</h3>
                    <p class="text-gray-400 ml-8">Pour l'installation du service, vous devrez vous procurer:<br> - <a href="https://nodejs.org/fr" class="text-blue-500">Node [v20.2.0 de préférence]</a><br>- <a href="https://www.php.net/downloads.php" class="text-blue-500">PHP [v7.4.x]</a><br>- <a href="https://getcomposer.org/download/" class="text-blue-500">Composer</a></p>

                    <h3 class="text-lg text-white ml-8 mt-4" id="installation">Installation</h3>
                    <p class="text-gray-400 ml-8">Une fois installé sur votre système, vous devrez télécharger le projet qui sera trouvable sur <a href="#" class="text-blue-500">Github</a>. Puis, vous rendre dans le dossier depuis votre terminal à l'aide de<br><code>
                            <span class="text-green-500">$</span> <span class="text-white">cd Laravel-main</span>
                        </code>
                    </p>
                    <br>
                    <p class="text-gray-400 ml-8">Une fois accédé, vous devrez installer toutes ces dépendances grâce à l'aide de Npm (Node):<br><code>
                            <span class="text-green-500">$</span> <span class="text-white">npm install</span>
                        </code></p><br>


                    <p class="text-gray-400 ml-8">Ensuite, vous devrez ouvrir un deuxième terminal et exécuter respectivement ces deux commandes-ci dans leur terminal:<br>Terminal A:<code>
                            <span class="text-green-500">$</span> <span class="text-white">php artisan serve</span>
                        </code><br>Terminal B:<code>
                            <span class="text-green-500">$</span> <span class="text-white">npm run dev</span>
                        </code></p><br><br>

                    <img src="./success-installation.png" alt="success-installtion" class="w-2/3 ml-8">
                    <p class="text-gray-400 ml-8">Si vous n'obtenez pas d'erreur et que vous arrivez à cette page, bien joué à vous ! Vous venez d'installer Appliweb2 correctement !</p>

                    <h3 class="text-lg text-white ml-8 mt-4" id="configuration">Configuration</h3>
                </section>
            </main>
        </div>
    </div>




</x-app-layout>