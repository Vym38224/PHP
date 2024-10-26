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
        $logins[] = [
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'mobile' => $user['mobile'],
            'room' => $user['room'],
            'life' => $user['life'],
            'is_admin' => $user['is_admin'],
            'login_time' => date('Y-m-d H:i:s')
        ];
        file_put_contents('logins.json', json_encode($logins));
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php?url=login/index");
    }
}
