<?php
session_start(); // Přidání session_start() na začátek souboru

require "assets/database.php";
$connection = connectionDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($connection, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($connection, $_POST["last_name"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $mobile = mysqli_real_escape_string($connection, $_POST["mobile"]);
    $room = mysqli_real_escape_string($connection, $_POST["room"]);
    $life = mysqli_real_escape_string($connection, $_POST["life"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    $is_admin = mysqli_real_escape_string($connection, $_POST["is_admin"]);

    $sql = "INSERT INTO student (first_name, last_name, email, mobile, room, life, password, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt === false) {
        die('Prepare failed: ' . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, "sssissss", $first_name, $last_name, $email, $mobile, $room, $life, $password, $is_admin);

    if (mysqli_stmt_execute($stmt)) {
        // Uložení přihlášení do souboru
        $logins = [];
        if (file_exists('logins.json')) {
            $logins = json_decode(file_get_contents('logins.json'), true);
        }
        $logins[] = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'mobile' => $mobile,
            'room' => $room,
            'life' => $life,
            'password' => $password,
            'is_admin' => $is_admin
        ];
        // Uložení pouze posledních 10 přihlášení
        if (count($logins) > 10) {
            $logins = array_slice($logins, -10);
        }
        file_put_contents('logins.json', json_encode($logins));

        echo "Registrace byla úspěšná.";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Chyba při registraci: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Registrace</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./bootstrap-icons.css">
</head>

<body>
    <?php require_once("assets/header.php"); ?>
    <div class="container col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mt-5">Přidat nového uživatele</h1>
                <form method="POST" class="mt-4">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Jméno</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Jméno" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Příjmení</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Příjmení" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Telefon</label>
                        <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Telefon" required>
                    </div>
                    <div class="mb-3">
                        <label for="room" class="form-label">Pracovna</label>
                        <input type="text" name="room" id="room" class="form-control" placeholder="Pracovna" required>
                    </div>
                    <div class="mb-3">
                        <label for="life" class="form-label">Popisek</label>
                        <input type="text" name="life" id="life" class="form-control" placeholder="Popisek" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Heslo</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Heslo" required>
                    </div>
                    <div class="mb-3">
                        <label for="is_admin" class="form-label">Správce</label>
                        <input type="text" name="is_admin" id="is_admin" class="form-control" placeholder="Správce" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registrovat</button>
                </form>
            </div>
        </div>
    </div>

    <script src="./bootstrap.bundle.js"></script>
</body>

</html>