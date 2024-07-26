<?php
    $hour = 19;
?>

<!DOCTYPE html>
<html lang="cs-CZ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naše služby</title>
</head>
<body>
    <?php require_once "assets/header.php"; ?>
        <?php if ($hour < 12): ?>
            <h1>Dobré ráno!</h1>
        <?php elseif ($hour < 18): ?>
            <h1>Dobré odpoledne!</h1>
        <?php else: ?>
            <h1>Dobrý večer!</h1>
        <?php endif; ?>

        <?php 

            $students = ["Harry", "Ron", "Hermiona"]; 
        ?>

        <ul>
            <?php foreach ($students as $student): ?>
                <li><?php echo $student ?></li>
            <?php endforeach; ?>
        </ul>  
    <?php require_once "assets/footer.php"; ?>
</body>
</html>