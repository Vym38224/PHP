<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

require "assets/database.php";
require "assets/zak.php";
$connection = connectionDB();

session_start(); // Inicializace session

// Načtení informací o přihlášeném uživateli
$username = $_SESSION["username"];
$sql = "SELECT first_name, is_admin FROM student WHERE first_name = ?";
$stmt = mysqli_prepare($connection, $sql);
if ($stmt === false) {
    die("Chyba při přípravě dotazu: " . mysqli_error($connection));
}
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user === null) {
    die("Uživatel nenalezen. Dotaz: " . htmlspecialchars($sql) . " s parametrem: " . htmlspecialchars($username));
}

$first_name = $user['first_name'];
$is_admin = $user['is_admin'];

$students = getAllStudents($connection);
?>

<!doctype html>
<html lang="en">

<head>
    <title>Uživatelé</title>
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
    <header><?php require_once("assets/header.php"); ?></header>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
        <h1 class="pb-3 border-bottom">Users</h1>
        <section>

            <p>Přihlášen jako: <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
            <?php if ($is_admin && $_SESSION["username"] == $first_name): ?>
                <button class="btn btn-primary" onclick="window.location.href='registrace-form.php'">Přidat uživatele</button>
            <?php endif; ?>
            <table class="table">
                <h2> Výpis existujících uživatelů</h2>
                <thead>
                    <tr>
                        <th>Jméno</th>
                        <th>Příjmení</th>
                        <th>E-mail</th>
                        <th>Telefon</th>
                        <th>Pracovna</th>
                        <th>Popis</th>
                        <th>Heslo</th>
                        <th>Je Správce</th>
                        <?php if ($is_admin && $_SESSION["username"] == $first_name): ?>
                            <th>Akce</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student["first_name"]); ?></td>
                            <td><?php echo htmlspecialchars($student["last_name"]); ?></td>
                            <td><?php echo htmlspecialchars($student["email"]); ?></td>
                            <td><?php echo htmlspecialchars($student["mobile"]); ?></td>
                            <td><?php echo htmlspecialchars($student["room"]); ?></td>
                            <td><?php echo htmlspecialchars($student["life"]); ?></td>
                            <td><?php echo htmlspecialchars($student["password"]); ?></td>
                            <td><?php echo htmlspecialchars($student["is_admin"]); ?></td>
                            <?php if ($is_admin && $_SESSION["username"] == $first_name): ?>
                                <td>
                                    <a href="editace-zaka.php?id=<?php echo $student['id']; ?>" class="btn btn-primary">Editovat</a>
                                    <a href="delete-zak.php?id=<?php echo $student['id']; ?>" class="btn btn-danger">Odstranit</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>