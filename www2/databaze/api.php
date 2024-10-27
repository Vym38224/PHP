<?php
session_start();

require_once 'autoload.php';
require_once 'controllers/RouterController.php';
require_once 'models/User.php';

$rc = new routerController();
$router = "";
if ($_GET) {
    if (isset($_GET["url"])) {
        $url = $_GET["url"];
        $rc->process(array($url));
        $rc->renderView();
    }
}

require_once 'autoload.php';

$userModel = new User();

$method = $_SERVER['REQUEST_METHOD'];
$path = isset($_GET['path']) ? explode('/', trim($_GET['path'], '/')) : [];

header('Content-Type: application/json');

switch ($method) {
    case 'GET':
        if (empty($path)) {
            echo json_encode($userModel->getAllUsers());
        } elseif (count($path) == 2 && $path[0] == 'get') {
            echo json_encode($userModel->getUserById($path[1]));
        } else {
            echo json_encode(["error" => "Invalid endpoint"]);
        }
        break;
    case 'POST':
        if (empty($path)) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $room = $_POST['room'];
            $life = $_POST['life'];
            $is_admin = $_POST['is_admin'];
            echo json_encode(["success" => $userModel->addUser($first_name, $last_name, $email, $mobile, $room, $life, $is_admin)]);
        } elseif (count($path) == 2 && $path[0] == 'update') {
            $id = $path[1];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $room = $_POST['room'];
            $life = $_POST['life'];
            $is_admin = $_POST['is_admin'];
            echo json_encode(["success" => $userModel->updateUser($id, $first_name, $last_name, $email, $mobile, $room, $life, $is_admin)]);
        } else {
            echo json_encode(["error" => "Invalid endpoint"]);
        }
        break;
    case 'DELETE':
        if (count($path) == 2 && $path[0] == 'delete') {
            $id = $path[1];
            echo json_encode(["success" => $userModel->deleteUser($id)]);
        } else {
            echo json_encode(["error" => "Invalid endpoint"]);
        }
        break;
    default:
        echo json_encode(["error" => "Invalid request method"]);
        break;
}
