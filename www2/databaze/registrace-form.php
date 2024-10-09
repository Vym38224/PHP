<?php
require_once("assets/database.php");

$name = null;
$password = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $password = $_POST["password"];

    if (empty($_POST["name"]) or empty($_POST["password"])) {
        die("Vyplňte všechny údaje.");
    }

    $connection = connectionDB();

    $name = mysqli_escape_string($connection, $_POST["name"]);
    $password = mysqli_escape_string($connection, $_POST["password"]);

    $sql = "INSERT INTO student (name, password) 
        VALUES (?, ?)";

    $statement = mysqli_prepare($connection, $sql);

    if ($statement === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($statement, "ss", $name, $password);

        if (mysqli_stmt_execute($statement)) {
            $id = mysqli_insert_id($connection);
            // echo "Žák byl úspěšně přidán s id $id.";
            // přesměrování
            header("Location: dashboard.php?id=$id");
        } else {
            echo "Chyba: " . mysqli_stmt_error($statement);
        }
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Simple Administration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./bootstrap-icons.css">
</head>
<style>
    /* some hacks for responsive sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
        /* height of navbar */
    }

    .sidebar-sticky {
        height: calc(100vh - 48px);
        overflow-x: hidden;
        overflow-y: auto;
    }
</style>

<body>
    <header> <?php require "assets/header.php"; ?> </header>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
        <h1 class="pb-3 border-bottom">Simple Administration</h1>
        <?php require "assets/formular-zak.php"; ?>
    </main>
</body>

</html>