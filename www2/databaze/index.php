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
    echo json_encode($users);
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

function addUser($name, $surname)
{
    $users = loadUsers();
    $id = end($users)['id'] + 1;
    $users[] = ['id' => $id, 'name' => $name, 'surname' => $surname];
    saveUsers($users);
    echo "User added successfully";
}

function updateUser($id, $name, $surname)
{
    $users = loadUsers();
    foreach ($users as &$user) {
        if ($user['id'] == $id) {
            $user['name'] = $name;
            $user['surname'] = $surname;
            saveUsers($users);
            echo "User updated successfully";
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
            echo "User deleted successfully";
            return;
        }
    }
    http_response_code(404);
    echo "User not found";
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] === 'get') {
        getAllUsers();
    } elseif ($_GET['action'] === 'getById' && isset($_GET['id'])) {
        getUserById($_GET['id']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add' && isset($_POST['name']) && isset($_POST['surname'])) {
        addUser($_POST['name'], $_POST['surname']);
    } elseif ($_POST['action'] === 'update' && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['surname'])) {
        updateUser($_POST['id'], $_POST['name'], $_POST['surname']);
    } elseif ($_POST['action'] === 'delete' && isset($_POST['id'])) {
        deleteUser($_POST['id']);
    }
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
