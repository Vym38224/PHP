<?php

require "assets/database.php";
require "assets/zak.php";

$connection = connectionDB();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    deleteStudent($connection, $_GET["id"]);
    header("Location: users.php?id=$id");
}

?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smazat žáka</title>
    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./bootstrap-icons.css">
</head>
<style>
    body {
        padding-top: 50px;
        /* Odsazení pro pevné záhlaví */
    }

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
    <?php require "assets/header.php"; ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
        <section class="delete-form">
            <form method="POST">
                <p>Jste si jisti, že chcete tohoto uživatele odhlásit?</p>
                <button>Odhlásit</button>
                <button><a href="jeden-zak.php?id=<?= $_GET['id'] ?>">Zrušit</a></button>
            </form>
        </section>
    </main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">

    <?php require "assets/footer.php"; ?>
</body>

</html>