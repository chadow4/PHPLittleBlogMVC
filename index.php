<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT . 'app/Model.php');
require_once(ROOT . 'app/Controller.php');

$urlParams = explode('/', $_GET['p']);

routing($urlParams);
function routing(array $urlParams)
{
    if (is_string($urlParams[0]) && $urlParams[0] !== "") {
        $controller = ucfirst($urlParams[0]);

        $action = $urlParams[1] ?? 'index';

        $controllerFilePath = ROOT . 'controllers/' . $controller . '.php';
        if (file_exists($controllerFilePath)) {
            require $controllerFilePath;
            $controller = new $controller();
            if (method_exists($controller, $action)) {
                unset($urlParams[0]);
                unset($urlParams[1]);
                call_user_func_array([new $controller(), $action], $urlParams);
            } else {
                http_response_code(404);
                echo "La page recherchée n'existe pas";
            }
        } else {
            http_response_code(404);
            echo "La page recherchée n'existe pas";
        }
    } else {
        require_once(ROOT . 'controllers/Home.php');

        $controller = new Home();
        $controller->index();
    }
}

