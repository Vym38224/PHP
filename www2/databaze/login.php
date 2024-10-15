<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Uložení uživatelského jména do session
    $_SESSION["username"] = $_POST["username"];
    header("Location: dashboard.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Přihlášení</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mt-5">Přihlášení</h1>
                <form method="POST" class="mt-4">
                    <div class="mb-3">
                        <label for="username" class="form-label">Uživatelské jméno</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Uživatelské jméno" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Přihlásit se</button>
                </form>
            </div>
        </div>
    </div>

    <script src="./bootstrap.bundle.js"></script>
</body>

</html>