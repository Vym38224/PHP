<?php
require_once("assets/database.php");
require_once("assets/zak.php");

$connection = connectionDB();

if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
    $students = getStudent($connection, $_GET["id"]);
}
?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <header><?php require_once("assets/header.php"); ?></header>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
        <section>
            <h2 class="pb-3 border-bottom">Informace o žákovi</h2>
            <?php if ($students == NULL): ?>
                <p>Žák nenalezen</p>
            <?php else: ?>
                <h2>Jméno: <?php echo htmlspecialchars($students["first_name"]); ?></h2>
                <h2>Příjmení: <?php echo htmlspecialchars($students["last_name"]); ?></h2>
                <p>E-mail: <?php echo htmlspecialchars($students["email"]); ?></p>
                <p>Telefoní číslo: <?php echo htmlspecialchars($students["mobile"]); ?></p>
                <p>Pracovna: <?php echo htmlspecialchars($students["room"]); ?></p>
                <p>Popis: <?php echo htmlspecialchars($students["life"]); ?></p>
                <p>Heslo: <?php echo htmlspecialchars($students["password"]); ?></p>
                <p>Je Správce: <?php echo htmlspecialchars($students["is_admin"]); ?></p>


            <?php endif; ?>
        </section>
        <section class="buttons">
            <button><a href="delete-zak.php?id=<?= $students['id'] ?>">Odhlásit</a></button>
            <button><a href="editace-zaka.php?id=<?= $students['id'] ?>">Editovat</a></button>
        </section>
    </main>
    <footer><?php require_once("assets/footer.php"); ?></footer>
</body>

</html>