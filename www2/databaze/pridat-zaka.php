<?php
    require_once("assets/database.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST["first_name"];
        $second_name = $_POST["second_name"];
        $age = $_POST["age"];
        $life = $_POST["life"];
        $college = $_POST["college"];

        $sql = "INSERT INTO student (first_name, second_name, age, life, college) VALUES ('$first_name', '$second_name', '$age', '$life', '$college')";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
        header("Location: pridat-zaka.php");
    }

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
        <section>
            <h1>Přidání žáka</h1>
            <form action="pridat-zaka.php" method="post">               
                <input type="text" name="first_name" id="first_name" placeholder="Jméno">
                <br>                
                <input type="text" name="second_name" id="second_name" placeholder="Příjmení">
                <br>                
                <input type="number" name="age" id="age" placeholder="Věk">
                <br>              
                <textarea type="text" name="life" id="life" placeholder="Život"></textarea>
                <br>
                <input type="text" name="college" id="college" placeholder="Kolej">
                <br>
                <input type="submit" value="Přidat žáka">
            </form>
            <p><a href="index.php">Zpět na hlavní stránku</a></p>
        </section>
    </main>
    <footer><?php require_once("assets/footer.php");?></footer>
</body>
</html>