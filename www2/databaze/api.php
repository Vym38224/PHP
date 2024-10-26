<?php
session_start();

define('USER_FILE', 'users.json');

function loadUsers()
{
    if (file_exists(USER_FILE)) {
        $json = file_get_contents(USER_FILE);
        return json_decode($json, true);
    }
    return [];
}

function saveUsers($users)
{
    $json = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents(USER_FILE, $json);
}

function getUsers()
{
    $users = loadUsers();
    $csv = "id,name,surname\n";
    foreach ($users as $user) {
        $csv .= "{$user['id']},{$user['name']},{$user['surname']}\n";
    }
    return $csv;
}

function getUserById($id)
{
    $users = loadUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return "{$user['id']},{$user['name']},{$user['surname']}\n";
        }
    }
    return "User not found\n";
}

function addUser($id, $name, $surname)
{
    $users = loadUsers();
    $users[] = ['id' => $id, 'name' => $name, 'surname' => $surname];
    saveUsers($users);
    return "User added\n";
}

function updateUser($id, $name, $surname)
{
    $users = loadUsers();
    foreach ($users as &$user) {
        if ($user['id'] == $id) {
            $user['name'] = $name;
            $user['surname'] = $surname;
            saveUsers($users);
            return "User updated\n";
        }
    }
    return "User not found\n";
}

function deleteUser($id)
{
    $users = loadUsers();
    foreach ($users as $key => $user) {
        if ($user['id'] == $id) {
            unset($users[$key]);
            saveUsers($users);
            return "User deleted\n";
        }
    }
    return "User not found\n";
}

$method = $_SERVER['REQUEST_METHOD'];
$path = isset($_GET['path']) ? explode('/', trim($_GET['path'], '/')) : [];

header('Content-Type: text/plain');

switch ($method) {
    case 'GET':
        if (empty($path)) {
            echo getUsers();
        } elseif (count($path) == 2 && $path[0] == 'get') {
            echo getUserById($path[1]);
        } else {
            echo "Invalid endpoint\n";
        }
        break;
    case 'POST':
        if (empty($path)) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            echo addUser($id, $name, $surname);
        } elseif (count($path) == 2 && $path[0] == 'update') {
            $id = $path[1];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            echo updateUser($id, $name, $surname);
        } else {
            echo "Invalid endpoint\n";
        }
        break;
    case 'DELETE':
        if (count($path) == 2 && $path[0] == 'delete') {
            $id = $path[1];
            echo deleteUser($id);
        } else {
            echo "Invalid endpoint\n";
        }
        break;
    default:
        echo "Invalid request method\n";
        break;
}
