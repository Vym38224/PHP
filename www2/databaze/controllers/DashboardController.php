<?php
require_once "models/User.php";

class DashboardController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $last_logged_in_users = $this->userModel->getLastLoggedInUsers();
        require "views/dashboard/index.php";
    }

    public function deleteLogin()
    {
        if (isset($_POST['delete_user'])) {
            $email_to_delete = $_POST['email'];
            $last_logged_in_users = json_decode(file_get_contents('logins.json'), true);
            $last_logged_in_users = array_filter($last_logged_in_users, function ($user) use ($email_to_delete) {
                return $user['email'] !== $email_to_delete;
            });
            file_put_contents('logins.json', json_encode(array_values($last_logged_in_users)));
            header("Location: index.php?url=dashboard/index");
            exit();
        }
    }
}
