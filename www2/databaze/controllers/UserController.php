<?php
require_once "models/User.php";

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $users = $this->userModel->getAllUsers();
        require "views/users/index.php";
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $room = $_POST["room"];
            $life = $_POST["life"];
            $password = $_POST["password"];
            $is_admin = $_POST["is_admin"];

            // Zpracování hesla
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $hashed_password = null;
            }

            $this->userModel->addUser($first_name, $last_name, $email, $mobile, $room, $life, $hashed_password, $is_admin);
            header("Location: index.php?url=user/index&success=true");
        } else {
            require "views/users/add.php";
        }
    }

    public function edit()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $room = $_POST["room"];
            $life = $_POST["life"];
            $is_admin = $_POST["is_admin"];
            $password = $_POST["password"];

            // Zpracování hesla
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $this->userModel->updateUserWithPassword($id, $first_name, $last_name, $email, $mobile, $room, $life, $hashed_password, $is_admin);
            } else {
                $this->userModel->updateUser($id, $first_name, $last_name, $email, $mobile, $room, $life, $is_admin);
            }

            header("Location: index.php?url=user/index");
        } else {
            $id = $_GET["id"];
            $user = $this->userModel->getUserById($id);
            require "views/users/edit.php";
        }
    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $this->userModel->deleteUserById($id);
            header("Location: index.php?url=user/index");
        } else {
            $id = $_GET["id"];
            require "views/users/delete.php";
        }
    }
}
