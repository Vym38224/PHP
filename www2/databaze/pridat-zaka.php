<?php
    require_once("assets/database.php");

    $first_name = null;
    $second_name = null;
    $age = null;
    $life = null;
    $college = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $first_name = $_POST["first_name"];
        $second_name = $_POST["second_name"];
        $age = $_POST["age"];
        $life = $_POST["life"];
        $college = $_POST["college"];

        if(empty($_POST["first_name"]) or empty($_POST["second_name"]) or empty($_POST["age"]) or empty($_POST["life"]) or empty($_POST["college"])){
            die("Vyplňte všechny údaje.");
        }

        $connection = connectionDB();

        $first_name = mysqli_escape_string($connection, $_POST["first_name"]);
        $second_name = mysqli_escape_string($connection, $_POST["second_name"]);
        $age = mysqli_escape_string($connection, $_POST["age"]);
        $life = mysqli_escape_string($connection, $_POST["life"]);
        $college = mysqli_escape_string($connection, $_POST["college"]);

        $sql = "INSERT INTO student (first_name, second_name, age, life, college) 
        VALUES (?, ?, ?, ?, ?)";
            
        $statement = mysqli_prepare($connection, $sql);

        if ($statement === false) {
            echo mysqli_error($connection);
        } else {
            mysqli_stmt_bind_param($statement, "ssiss", $first_name, $second_name, $age, $life, $college);
            
            if (mysqli_stmt_execute($statement)) {
                $id = mysqli_insert_id($connection);
                // echo "Žák byl úspěšně přidán s id $id.";
                // přesměrování
                header("Location: jeden-zak.php?id=$id");
            } else {
                echo "Chyba: " . mysqli_stmt_error($statement);
            }
        }
       
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
                <input type="text" 
                        name="first_name" 
                        id="first_name" 
                        placeholder="Jméno" 
                        required
                        value = "<?php echo htmlspecialchars($first_name)?>">    
                <br>                
                <input type="text"
                        name="second_name" 
                        id="second_name" 
                        placeholder="Příjmení" 
                        required
                        value = "<?php echo htmlspecialchars($second_name)?>">
                <br>                
                <input type="number"
                        name="age" 
                        id="age" 
                        placeholder="Věk" 
                        required
                        value = "<?php echo htmlspecialchars($age)?>">
                <br>              
                <textarea type="text"
                            name="life" 
                            id="life" 
                            placeholder="Život"
                            required><?php echo htmlspecialchars($life)?></textarea>
                <br>
                <input type="text"
                        name="college" 
                        id="college" 
                        placeholder="Kolej" 
                        required
                        value = "<?php echo htmlspecialchars($college)?>">
                <br>
                <input type="submit" value="Přidat žáka">
            </form>
        </section>
    </main>
    <footer><?php require_once("assets/footer.php");?></footer>
</body>
</html>