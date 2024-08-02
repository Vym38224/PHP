<?php 
    require_once("assets/database.php");
    $connection = connectionDB();
    
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
    <header><?php require_once("assets/header.php");?></header>
    <main>
        <h2>Seznam žáků školy</h2>
        <section>
            <?php if (count($students) > 0): ?>
                <ul>
                    <?php foreach ($students as $student): ?>
                        <li>
                            <?php echo htmlspecialchars($student["first_name"] . " " . $student["second_name"]); ?>
                        </li>
                        <a href="jeden-zak.php?id=<?php echo $student['id']; ?>">Zobrazit informace</a>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Žádní žáci nebyli nalezeni</p>
            <?php endif; ?>
        </section>
    </main>
    <footer><?php require_once("assets/footer.php");?></footer>
</body>
</html>
