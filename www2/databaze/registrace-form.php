<?php
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

<form method="POST">
    <input type="text"
        name="first_name"
        placeholder="Jméno"
        required><br>

    <input type="text"
        name="last_name"
        placeholder="Příjmení"
        required><br>

    <input type="text"
        name="email"
        placeholder="E-mail"
        required><br>

    <input type="number"
        name="mobile"
        placeholder="Telefon"
        required><br>

    <input type="text"
        name="room"
        placeholder="Pracovna"
        required><br>

    <input type="text"
        name="life"
        placeholder="Popisek"
        required><br>

    <input type="password"
        name="password"
        placeholder="Heslo"
        required><br>

    <input type="text"
        name="is_admin"
        placeholder="Správce"
        required><br>

    <button type="submit">Registrovat</button>
</form>