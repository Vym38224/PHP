<?php
require_once("assets/database.php");
$connection = connectionDB();

$sql = "SELECT * FROM student";

$result = mysqli_query($connection, $sql);
if ($result == false) {
    echo mysqli_error($connection);
    exit;
} else {
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
// var_dump($students);

?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
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
        <h1>Users</h1>
        <section>
            <?php if (count($students) > 0): ?>
                <ul>
                    <?php foreach ($students as $student): ?>
                        <li>
                            <?php echo htmlspecialchars($student["name"]); ?>
                        </li>
                        <button><a href="jeden-zak.php?id=<?php echo $student['id']; ?>">Zobrazit informace</a></button>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Žádní žáci nebyli nalezeni</p>
            <?php endif; ?>
        </section>
    </main>
    <footer><?php require_once("assets/footer.php"); ?></footer>
</body>

</html>