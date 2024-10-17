<?php
session_start();

require "assets/database.php";
require "assets/zak.php";
$connection = connectionDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    deleteStudent($connection, $id);
    header("Location: users.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: users.php");
    exit();
}

$id = $_GET["id"];
$student = getStudent($connection, $id);
if (!$student) {
    header("Location: users.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>odstranit uživatele</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./bootstrap-icons.css">
    <style>
        body {
            padding-top: 70px;
            /* Odsazení pro pevné záhlaví */
        }

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

        .card {
            width: 50%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <?php require "assets/header.php"; ?>
    <main class="container main-content col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
        <section class="delete-form">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Odstranit uživatele</h5>
                    <p class="card-text">Jste si jisti, že chcete tohoto uživatele odstranit?</p>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        <button type="submit" class="btn btn-danger">Odstranit</button>
                        <a href="users.php" class="btn btn-secondary">Zrušit</a>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script src="./bootstrap.bundle.js"></script>
</body>

</html>