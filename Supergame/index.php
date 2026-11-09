<?php
//7)	Le fichier index.php sert de point d’entrée. Il va donc exécuter le code comme suit :
//- Créer un objet controllerHome en lui forunissant un ModelPlayer et un ViewHome
//- Lancer registerPlayer()
//- Lancer displayPlayers()
//- Lancer render()


// 1. Inclusion des fichiers dans l'ordre des dépendances (classes parents avant classes enfants)
require_once './utils/utils.php';
require_once './model/Model.php';
require_once './model/ModelPlayer.php';
require_once './view/View.php';
require_once './view/ViewHome.php';
require_once './controller/Controller.php';
require_once './controller/ControllerHome.php';

// 2. Instanciation de ControllerHome avec un ModelPlayer et une ViewHome
$controllerHome = new ControllerHome(new ModelPlayer(), new ViewHome());

// 3. Exécution des méthodes dans l'ordre demandé (avec chaînage)
$controllerHome->registerPlayer()
               ->displayPlayers()
               ->render();