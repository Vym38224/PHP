<?php
session_start();

define('USER_FILE', 'users.json');

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
    file_put_contents(USER_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

function getAllUsers()
{
    $users = loadUsers();
    header('Content-Type: application/json');
    echo json_encode($users);
}

function getUserById($id)
{
    $users = loadUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            header('Content-Type: application/json');
            echo json_encode($user);
            return;
        }
    }
    http_response_code(404);
    echo json_encode(['message' => 'User not found']);
}

function createUser($data)
{
    $users = loadUsers();
    $newUser = [
        'id' => uniqid(),
        'name' => isset($data['name']) ? $data['name'] : '',
        'surname' => isset($data['surname']) ? $data['surname'] : ''
    ];
    $users[] = $newUser;
    saveUsers($users);
    http_response_code(201);
    echo json_encode($newUser);
}

function updateUser($id, $data)
{
    $users = loadUsers();
    foreach ($users as &$user) {
        if ($user['id'] == $id) {
            // Přepsání všech atributů uživatele
            $user['name'] = isset($data['name']) ? $data['name'] : $user['name'];
            $user['surname'] = isset($data['surname']) ? $data['surname'] : $user['surname'];
            saveUsers($users);
            echo json_encode($user);
            return;
        }
    }
    http_response_code(404);
    echo json_encode(['message' => 'User not found']);
}

function deleteUser($id)
{
    $users = loadUsers();
    foreach ($users as $key => $user) {
        if ($user['id'] == $id) {
            unset($users[$key]);
            saveUsers($users);
            echo json_encode(['message' => 'User deleted']);
            return;
        }
    }
    http_response_code(404);
    echo json_encode(['message' => 'User not found']);
}

// Routing
$method = $_SERVER['REQUEST_METHOD'];
$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
$request = explode('/', trim($pathInfo, '/'));

switch ($method) {
    case 'GET':
        if (isset($request[0]) && $request[0] === 'users') {
            if (isset($request[1])) {
                getUserById($request[1]);
            } else {
                getAllUsers();
            }
        }
        break;
    case 'POST':
        if (isset($request[0]) && $request[0] === 'users') {
            // Získání dat z URL parametrů
            $data = [
                'name' => isset($_GET['name']) ? $_GET['name'] : '',
                'surname' => isset($_GET['surname']) ? $_GET['surname'] : ''
            ];
            createUser($data);
        }
        break;
    case 'PUT':
        if (isset($request[0]) && $request[0] === 'users' && isset($request[1])) {
            // Získání dat z URL parametrů
            $data = [
                'name' => isset($_GET['name']) ? $_GET['name'] : '',
                'surname' => isset($_GET['surname']) ? $_GET['surname'] : ''
            ];
            updateUser($request[1], $data);
        }
        break;
    case 'DELETE':
        if (isset($request[0]) && $request[0] === 'users' && isset($request[1])) {
            deleteUser($request[1]);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method not allowed']);
        break;
}
