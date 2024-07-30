<?php 

    $db_host = "localhost";
    $db_user = "jaroslavvymetal";
    $db_password = "heslo";
    $db_name = "skola";

    $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    $sql = "SELECT * FROM student WHERE id = " . $_GET["id"];
    
    $result = mysqli_query($connection, $sql);

    if ($result == false) {
        echo mysqli_error($connection);
        exit;
    } else{
        $students = mysqli_fetch_assoc($result);
    }
    // var_dump($students);
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
    <header>
        <h1>Informace o žákovi</h1>
    </header>

    <main>
        <section>
            <?php if ($students == NULL): ?>
                <p>Žák nenalezen</p>
            <?php else: ?>
                <h2><?php echo $students["first_name"] . " " . $students["second_name"]; ?></h2>
                <p>Věk: <?php echo $students["age"]; ?></p>
                <p>Život: <?php echo $students["life"]; ?></p>
                <p>Kolej: <?php echo $students["college"]; ?></p>
            <?php endif; ?>  
    </main>

    <footer></footer>
</body>
</html>