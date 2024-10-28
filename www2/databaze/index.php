<?php
session_start();

define('USER_FILE', 'users.txt');

function loadUsers()
{
    if (!file_exists(USER_FILE)) {
        return [];
    }
    $fileContent = file_get_contents(USER_FILE);
    return $fileContent ? json_decode($fileContent, true) : [];
}

function saveUsers($users)
{
    file_put_contents(USER_FILE, json_encode($users));
}

function getAllUsers()
{
    $users = loadUsers();
    header('Content-Type: text/csv');
    foreach ($users as $user) {
        echo implode(',', $user) . "\n";
    }
}

function getUserById($id)
{
    $users = loadUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            header('Content-Type: text/csv');
            echo implode(',', $user) . "\n";
            return;
        }
    }
    http_response_code(404);
    echo "User not found";
}

function saveUser($id, $name, $surname)
{
    $users = loadUsers();
    $users[] = ['id' => $id, 'name' => $name, 'surname' => $surname];
    saveUsers($users);
    echo "User saved";
}

function updateUser($id, $name, $surname)
{
    $users = loadUsers();
    foreach ($users as &$user) {
        if ($user['id'] == $id) {
            $user['name'] = $name;
            $user['surname'] = $surname;
            saveUsers($users);
            echo "User updated";
            return;
        }
    }
    http_response_code(404);
    echo "User not found";
}

function deleteUser($id)
{
    $users = loadUsers();
    foreach ($users as $key => $user) {
        if ($user['id'] == $id) {
            unset($users[$key]);
            saveUsers($users);
            echo "User deleted";
            return;
        }
    }
    http_response_code(404);
    echo "User not found";
}

$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = rtrim($url, '/');
$url = explode('/', $url);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (count($url) == 1 && $url[0] == 'get') {
            getAllUsers();
        } elseif (count($url) == 2 && $url[0] == 'get') {
            getUserById($url[1]);
        } else {
            http_response_code(404);
            echo "Invalid endpoint";
        }
        break;
    case 'POST':
        if (count($url) == 1 && $url[0] == 'post') {
            saveUser($_POST['id'], $_POST['name'], $_POST['surname']);
        } elseif (count($url) == 2 && $url[0] == 'update') {
            updateUser($url[1], $_POST['name'], $_POST['surname']);
        } else {
            http_response_code(404);
            echo "Invalid endpoint";
        }
        break;
    case 'DELETE':
        if (count($url) == 2 && $url[0] == 'delete') {
            deleteUser($url[1]);
        } else {
            http_response_code(404);
            echo "Invalid endpoint";
        }
        break;
    default:
        http_response_code(405);
        echo "Method not allowed";
        break;
}

require_once "controllers/UserController.php";
require_once "controllers/LoginController.php";
require_once "controllers/DashboardController.php";
require_once "controllers/ItemsController.php";
require_once "controllers/OthersController.php";
require_once "controllers/RouterController.php";

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
