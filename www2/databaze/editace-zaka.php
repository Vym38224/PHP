<?php
session_start(); // Přidání session_start() na začátek souboru

require "assets/database.php";
require "assets/zak.php";
$connection = connectionDB();

if (isset($_GET["id"])) {
    $one_student = getStudent($connection, $_GET["id"]);
    if ($one_student) {
        $first_name = $one_student["first_name"];
        $last_name = $one_student["last_name"];
        $email = $one_student["email"];
        $mobile = $one_student["mobile"];
        $room = $one_student["room"];
        $life = $one_student["life"];
        $password = $one_student["password"];
        $is_admin = $one_student["is_admin"];
        $id = $one_student["id"];
    } else {
        die("Student nenalezen");
    }
} else {
    die("ID není zadáno, student nebyl nalezen");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $room = $_POST["room"];
    $life = $_POST["life"];
    $password = $_POST["password"];
    $is_admin = $_POST["is_admin"];

    updateStudent($connection, $first_name, $last_name, $email, $mobile, $room, $life, $password, $is_admin, $id);
    header("Location: users.php?id=$id");
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Editace žáka</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./bootstrap-icons.css">
</head>
<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
    }

    .sidebar-sticky {
        height: calc(100vh - 48px);
        overflow-x: hidden;
        overflow-y: auto;
    }
</style>

<body>
    <?php require_once("assets/header.php"); ?>
    <div class="container col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mt-5">Editace žáka</h1>
                <form method="POST" class="mt-4">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Jméno</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Jméno" value="<?= htmlspecialchars($first_name) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Příjmení</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Příjmení" value="<?= htmlspecialchars($last_name) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" value="<?= htmlspecialchars($email) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Telefon</label>
                        <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Telefon" value="<?= htmlspecialchars($mobile) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="room" class="form-label">Pracovna</label>
                        <input type="text" name="room" id="room" class="form-control" placeholder="Pracovna" value="<?= htmlspecialchars($room) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="life" class="form-label">Popisek</label>
                        <input type="text" name="life" id="life" class="form-control" placeholder="Popisek" value="<?= htmlspecialchars($life) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Heslo</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Heslo" value="<?= htmlspecialchars($password) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="is_admin" class="form-label">Správce</label>
                        <input type="text" name="is_admin" id="is_admin" class="form-control" placeholder="Správce" value="<?= htmlspecialchars($is_admin) ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Uložit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="./bootstrap.bundle.js"></script>
</body>

</html>