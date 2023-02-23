<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT . 'app/Model.php');
require_once(ROOT . 'app/Controller.php');

$myparams = explode('/', $_GET['p']);

if ($myparams[0] != "") {
    $controller = ucfirst($myparams[0]);

    $action = isset($myparams[1]) ? $myparams[1] : 'index';

    $controllerFilePath = ROOT . 'controllers/' . $controller . '.php';
    if (file_exists($controllerFilePath)) {
        require_once($controllerFilePath);
    }else{
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }

    $controller = new $controller();

    if (method_exists($controller, $action)) {
        unset($myparams[0]);
        unset($myparams[1]);
        call_user_func_array([$controller, $action], $myparams);
    } else {
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
} else {
    require_once(ROOT . 'controllers/Home.php');

    $controller = new Home();
    $controller->index();
}
