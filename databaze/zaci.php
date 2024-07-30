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

    // echo "Připojení proběhlo úspěšně";

    $sql = "SELECT * FROM student";
    
    $result = mysqli_query($connection, $sql);
    if ($result == false) {
        echo mysqli_error($connection);
        exit;
    } else{
        $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    // var_dump($students);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Seznam žáků školy</h1>
    <?php if (count($students) > 0): ?>
        <ul>
            <?php foreach ($students as $student): ?>
                <li>
                    <?php echo $student["first_name"] . " " . $student["second_name"]; ?>
                </li>
                <a href="jeden-zak.php?id=<?php echo $student["id"]; ?>">Zobrazit informace</a>
            <?php endforeach; ?>
    <?php else: ?>
        <p>Žádní žáci nebyli nalezeni</p>
    <?php endif; ?>
    <p><a href="index.php">Zpět na hlavní stránku</a></p>

</body>
</html>