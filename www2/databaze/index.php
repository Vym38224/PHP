<?php
session_start();

require_once "controllers/UserController.php";
require_once "controllers/LoginController.php";
require_once "controllers/DashboardController.php";
require_once "controllers/ItemsController.php";
require_once "controllers/OthersController.php";

$url = isset($_GET['url']) ? $_GET['url'] : 'dashboard/index';
$url = rtrim($url, '/');
$url = explode('/', $url);

$controller = ucfirst($url[0]) . 'Controller';
$action = isset($url[1]) ? $url[1] : 'index';

// Kontrola přihlášení
if (!isset($_SESSION['username']) && $controller !== 'LoginController') {
    header("Location: index.php?url=login/index");
    exit();
}

if (file_exists("controllers/$controller.php")) {
    require_once "controllers/$controller.php";
    $controllerInstance = new $controller();
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        require "views/404.php";
    }
} else {
    require "views/404.php";
}
