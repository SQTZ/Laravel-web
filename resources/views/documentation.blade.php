<x-app-layout>

    <div x-data="{ open: true }" class="flex h-full">
        <!-- Sidebar -->
        <div :class="{ 'hidden': !open, 'block': open, 'fixed': open, 'overflow-y-auto': open, 'h-full': open }" class="bg-gray-800 text-white w-64 py-6 px-4">
            <h2 class="font-semibold mb-2"><a href="#introduction"><span class="text-blue-500"># </span>Introduction</a></h2>
            <h2 class=" font-semibold mb-2"><a href="#installation_et_configuration"><span class="text-blue-500"># </span>Installation & Configuration</a></h2>
            <nav>
                <a href="#prerequis" class="block py-2 px-2 rounded hover:bg-gray-700 text-gray-400 text-sm">Prérequis</a>
                <a href="#installation" class="block py-2 px-2 rounded hover:bg-gray-700 text-gray-400 text-sm">Installation</a>
                <a href="#configuration" class="block py-2 px-2 rounded hover:bg-gray-700 text-gray-400 text-sm">Configuration</a>
            </nav>
        </div>

        <!-- Content -->
        <div :class="{ 'ml-64': open, 'ml-0': !open }" class="flex-1 flex flex-col">
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
                    <h3 class="text-lg text-white ml-8 mt-8" id="prerequis">Prérequis</h3>
                    <p class="text-gray-400 ml-8">Pour l'installation du service, vous devrez vous procurer:<br> - <a href="https://nodejs.org/fr" class="text-blue-500">Node [v20.2.0 de préférence]</a><br>- <a href="https://www.php.net/downloads.php" class="text-blue-500">PHP [v7.4.x]</a><br>- <a href="https://getcomposer.org/download/" class="text-blue-500">Composer</a></p>

                    <h3 class="text-lg text-white ml-8 mt-8" id="installation">Installation</h3>
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

                    <h3 class="text-lg text-white ml-8 mt-8" id="configuration">Configuration</h3>
                    <p class="text-gray-400 ml-8">Maintenant il est temps de configurer notre base de données et de l'appliquer dans notre application.</p>
                    <h4 class="text-white ml-8 mt-4">Passage sur LocalHost, étape 1:</h4>
                    <p class="text-gray-400 ml-8">Assurez-vous d'avoir installé <a href="https://wampserver.aviatechno.net/" class="text-blue-500">Wamp</a>, elle permet de prendre en charge les projets utilisant une base de donnée incluant du PHP. Lorsque vous avez installé, il suffit d'aller sur <a href="http://localhost" class="text-blue-500">localhost</a>. Vous obtiendrez une page comme ceci:</p>
                    <img src="./wamp-home.png" alt="Accueil de wamp" class="w-2/3 ml-8">
                    <p class="text-gray-400 ml-8 mt-4">Une fois arrivé sur cette page, vous devrez vous rendre dans la section <span class="font-bold">PhpMyAdmin 5.1.1</span>, vous arriverez sur une page de connexion</p>
                    <img src="./login-phpmyadmin.png" alt="Page de login phpmyadmin" class="w-2/3 ml-8">
                    <p class="text-gray-400 ml-8 mt-4">Vous n'avez rien à rentrer dans les champs demandés, il faudra juqte cliquer sur <span class="font-bold">Exécuter</span>.</p>
                    <p class="text-gray-400 ml-8 mt-4">Maintenant la prochaine étape est de créer votre base de données. Vous devrez aller dans <span class="font-bold">Nouvelle base de données</span> et de saisir un nom pour votre base.</p>
                    <img src="./create-database-part1.png" alt="Etape de création de la database" class="ml-8">
                    <h4 class="text-white ml-8 mt-4">étape 2:</h4>
                    <p class="text-gray-400 ml-8 mt-4">Maintenant il faut renseigner votre base de données dans l'application, pour cela vous devrez vous rendre dans dossier appliweb2 puis dans <span class="font-bold">.env</span>, puis de renseigner votre base de données, elle doit ressembler comme ceci (REMARQUE: les inscriptions écrites dans la capture sont un exemple pour vous montrer comment on doit intégrer votre base de données, modifiez les informations avec votre base de données actuelle !):</p>
                    <img src="./integrate-database.png" alt="intégrer la base de données" class="w-1/3 ml-8">
                    <p class="text-gray-400 ml-8 mt-4">C'est fait ? Super ! Maintenant ouvrons un troisième et dernier terminal, celui-ci va nous permettre d'installer les modules qu'il faut que ce soit pour l'application comme pour la base de données. Redirigez-vous dans votre dossier appliweb2 et exécutez cette commande: <code>
                            <span class="text-green-500">$</span> <span class="text-white">php artisan migrate</span>
                        </code><br>Il à pour but d'intégrer toutes les données dans votre base de données.<br>Si vous n'obtenez pas d'erreur, alors tout doit être intégré dans votre base de donnée, vous devrez avoir 12 tables. Si tout est bon, félicitations ! Vous venez de finaliser votre relation entre l'application et la base de données, à vous de l'utilisez !</p>

                        <h4 class="text-white ml-8 mt-4">Passage sous Hébergeur/VPS, étape 1:</h4>
                        <p class="text-gray-400 ml-8 mt-4">Si vous le mettez pas sur une machine en localhost, commencez à l'étape <span class="font-bold">[ étape 2 ]</span> !</p>
                </section>
            </main>
        </div>
    </div>




</x-app-layout>