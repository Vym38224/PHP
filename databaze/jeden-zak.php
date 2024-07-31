<?php 
    require_once("database.php");

    if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
        $sql = "SELECT * FROM student WHERE id = " . $_GET["id"];
    
        $result = mysqli_query($connection, $sql);

        if ($result == false) {
            echo mysqli_error($connection);
            exit;
        } else{
            $students = mysqli_fetch_assoc($result);
        }
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
    <header><?php require_once("header.php");?></header>
    <main>
        <section>
            <h2>Informace o žákovi</h2>
            <?php if ($students == NULL): ?>
                <p>Žák nenalezen</p>
            <?php else: ?>
                <h2><?php echo $students["first_name"] . " " . $students["second_name"]; ?></h2>
                <p>Věk: <?php echo $students["age"]; ?></p>
                <p>Život: <?php echo $students["life"]; ?></p>
                <p>Kolej: <?php echo $students["college"]; ?></p>
            <?php endif; ?>  
    </main>
    <footer><?php require_once("footer.php");?></footer>
</body>
</html>