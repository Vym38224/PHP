<?php
require_once "models/User.php";

class LoginController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        require "views/login/index.php";
    }

    public function authenticate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $user = $this->userModel->getUserByEmail($email);
            if ($user) {
                $_SESSION["username"] = $user["email"];
                $_SESSION["is_admin"] = $user["is_admin"];
                $this->logUserLogin($user);
                header("Location: index.php?url=dashboard/index");
                exit();
            } else {
                $error = "Uživatel nenalezen.";
                require "views/login/index.php";
            }
        }
    }

    private function logUserLogin($user)
    {
        $logins = [];
        if (file_exists('logins.json')) {
            $logins = json_decode(file_get_contents('logins.json'), true);
        }
        $newId = count($logins) > 0 ? max(array_column($logins, 'id')) + 1 : 1;
        $logins[] = [
            'id' => $newId,
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'mobile' => $user['mobile'],
            'room' => $user['room'],
            'life' => $user['life'],
            'is_admin' => $user['is_admin'],
            'login_time' => date('Y-m-d H:i:s')
        ];
        file_put_contents('logins.json', json_encode($logins, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php?url=login/index");
    }

    public function deleteLogEntry($loginTime)
    {
        $filePath = 'logins.json';
        $logs = json_decode(file_get_contents($filePath), true);
        // Find the index of the specific log entry
        $index = array_search($loginTime, array_column($logs, 'login_time'));
        // Remove the specific log entry if it exists
        if ($index !== false) {
            array_splice($logs, $index, 1);
        }
        file_put_contents($filePath, json_encode($logs, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public function handleDeleteLogRequest()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['loginTime'])) {
            $this->deleteLogEntry($data['loginTime']);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        }
    }
}

// Simple routing mechanism
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/www2/databaze/controllers/LoginController.php/api/delete-log') {
    $controller = new LoginController();
    $controller->handleDeleteLogRequest();
}
