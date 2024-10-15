<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Uložení uživatelského jména do session
    $_SESSION["username"] = $_POST["username"];
    header("Location: dashboard.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Přihlášení</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <h1>Přihlášení</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Uživatelské jméno" required><br>
        <button type="submit">Přihlásit se</button>
    </form>
</body>

</html>