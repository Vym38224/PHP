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
</head>
<body>
    <header><?php require_once("assets/header.php");?></header>
    <main>
        <section>
            <h2>Informace o žákovi</h2>
            <?php if ($students == NULL): ?>
                <p>Žák nenalezen</p>
            <?php else: ?>
                <h2><?php echo htmlspecialchars($students["first_name"] . " " . $students["second_name"]); ?></h2>
                <p>Věk: <?php echo htmlspecialchars($students["age"]); ?></p>
                <p>Život: <?php echo htmlspecialchars($students["life"]); ?></p>
                <p>Kolej: <?php echo htmlspecialchars( $students["college"]); ?></p>
            <?php endif; ?> 
        </section> 
        <section class="buttons">
                <a href="editace-zaka.php?id=<?= $students['id'] ?>">Editovat</a>
                <a href="delete-zak.php?id=<?= $students['id'] ?>">Vymazat</a>
        </section>      
    </main>
    <footer><?php require_once("assets/footer.php");?></footer>
</body>
</html>