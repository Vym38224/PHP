<?php
session_start();

require "assets/database.php";
$connection = connectionDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($connection, $_POST["email"]);

    $sql = "SELECT * FROM student WHERE email = ?";
    $stmt = mysqli_prepare($connection, $sql);
    if ($stmt === false) {
        die("Chyba při přípravě dotazu: " . mysqli_error($connection));
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Uložení uživatelského e-mailu do session
        $_SESSION["username"] = $user["email"];

        // Uložení přihlášení do souboru
        $logins = [];
        if (file_exists('logins.json')) {
            $logins = json_decode(file_get_contents('logins.json'), true);
        }
        $logins[] = [
            'first_name' => $user["first_name"],
            'last_name' => $user["last_name"],
            'email' => $user["email"],
            'mobile' => $user["mobile"],
            'room' => $user["room"],
            'life' => $user["life"],
            'is_admin' => $user["is_admin"],
            'login_time' => date('Y-m-d H:i:s')
        ];
        // Uložení pouze posledních 10 přihlášení
        if (count($logins) > 10) {
            $logins = array_slice($logins, -10);
        }
        file_put_contents('logins.json', json_encode($logins));

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Uživatel nenalezen.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
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
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                <form method="POST" class="mt-4">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Přihlásit se</button>
                </form>
            </div>
        </div>
    </div>

    <script src="./bootstrap.bundle.js"></script>
</body>

</html>