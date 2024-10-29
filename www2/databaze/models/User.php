<?php
require_once "assets/database.php";

class User
{
    private $connection;

    public function __construct()
    {
        $this->connection = connectionDB();
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM student";
        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM student WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM student WHERE email = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function addUser($first_name, $last_name, $email, $mobile, $room, $life, $password, $is_admin)
    {
        // Zpracování hesla
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $hashed_password = null;
        }

        $sql = "INSERT INTO student (first_name, last_name, email, mobile, room, life, password, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssi", $first_name, $last_name, $email, $mobile, $room, $life, $hashed_password, $is_admin);
        return mysqli_stmt_execute($stmt);
    }

    public function updateUser($id, $first_name, $last_name, $email, $mobile, $room, $life, $is_admin)
    {
        $sql = "UPDATE student SET first_name = ?, last_name = ?, email = ?, mobile = ?, room = ?, life = ?, is_admin = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssii", $first_name, $last_name, $email, $mobile, $room, $life, $is_admin, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function updateUserWithPassword($id, $first_name, $last_name, $email, $mobile, $room, $life, $password, $is_admin)
    {
        $sql = "UPDATE student SET first_name = ?, last_name = ?, email = ?, mobile = ?, room = ?, life = ?, password = ?, is_admin = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssi", $first_name, $last_name, $email, $mobile, $room, $life, $password, $is_admin, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM student WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }


    public function deleteUserById($id)
    {
        $sql = "DELETE FROM student WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }


    public function getLastLoggedInUsers()
    {
        if (file_exists('logins.json')) {
            $logins = json_decode(file_get_contents('logins.json'), true);
            usort($logins, function ($a, $b) {
                return strtotime($b['login_time']) - strtotime($a['login_time']);
            });
            return array_slice($logins, 0, 10);
        }
        return [];
    }
}
