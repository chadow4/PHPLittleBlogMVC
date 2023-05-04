<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Définition de la constante ROOT en utilisant le chemin du fichier index.php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
define('APP', basename(__DIR__));


// Inclusion des fichiers Model.php et Controller.php
require_once(ROOT . 'app/Model.php');
require_once(ROOT . 'app/Controller.php');

// Récupération des paramètres d'URL en les séparant avec le caractère "/"
$urlParams = explode('/', $_GET['p']);

// Appel de la fonction routing avec les paramètres d'URL en argument
routing($urlParams);

// Définition de la fonction routing qui prend en paramètre un tableau contenant les paramètres d'URL
function routing(array $urlParams)
{
    // Vérification que le premier paramètre est une chaîne de caractères non vide
    if (is_string($urlParams[0]) && $urlParams[0] !== "") {

        // Récupération du nom du contrôleur en capitalisant la première lettre du premier paramètre
        $controller = ucfirst($urlParams[0]);

        // Récupération de la méthode à appeler en utilisant le deuxième paramètre, ou 'index' si aucun paramètre n'est présent
        $action = $urlParams[1] ?? 'index';

        // Construction du chemin vers le fichier du contrôleur
        $controllerFilePath = ROOT . 'controllers/' . $controller . '.php';

        // Vérification que le fichier du contrôleur existe
        if (file_exists($controllerFilePath)) {
            // Inclusion du fichier du contrôleur
            require $controllerFilePath;

            // Création d'une instance du contrôleur
            $controller = new $controller();

            // Vérification que la méthode à appeler existe dans le contrôleur
            if (method_exists($controller, $action)) {
                // Suppression des deux premiers éléments du tableau de paramètres d'URL
                unset($urlParams[0]);
                unset($urlParams[1]);

                // Appel de la méthode avec les paramètres restants
                call_user_func_array([new $controller(), $action], $urlParams);
            } else {
                // Affichage d'une erreur 404 si la méthode n'existe pas dans le contrôleur
                http_response_code(404);
                echo "La page recherchée n'existe pas";
            }
        } else {
            // Affichage d'une erreur 404 si le fichier du contrôleur n'existe pas
            http_response_code(404);
            echo "La page recherchée n'existe pas";
        }
    } else {
        // Inclusion du fichier du contrôleur Home.php si aucun paramètre n'est présent dans l'URL
        require_once(ROOT . 'controllers/Home.php');

        // Création d'une instance du contrôleur Home et appel de la méthode index
        $controller = new Home();
        $controller->index();
    }
}
