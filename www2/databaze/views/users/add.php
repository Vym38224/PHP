<!doctype html>
<html lang="en">

<head>
    <title>Přidat uživatele</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons.css">
    <style>
        body {
            padding-top: 70px;
            /* Odsazení pro pevné záhlaví */
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            /* Adjust this value based on your sidebar width */
            height: 100%;
            z-index: 100;
            padding: 48px 0 0;
            background-color: #343a40;
            /* Sidebar background color */
        }

        .sidebar-sticky {
            height: calc(100vh - 48px);
            overflow-x: hidden;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 250px;
            /* Adjust this value based on your sidebar width */
        }
    </style>
</head>

<body>
    <header><?php require "assets/header.php"; ?></header>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3 main-content">
        <h1 class="pb-3 border-bottom">Přidat uživatele</h1>
        <form method="POST" action="index.php?url=user/add">
            <div class="mb-3">
                <label for="first_name" class="form-label">Jméno</label>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Jméno" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Příjmení</label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Příjmení" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Telefon</label>
                <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Telefon" required>
            </div>
            <div class="mb-3">
                <label for="room" class="form-label">Pracovna</label>
                <input type="text" name="room" id="room" class="form-control" placeholder="Pracovna" required>
            </div>
            <div class="mb-3">
                <label for="life" class="form-label">Popisek</label>
                <input type="text" name="life" id="life" class="form-control" placeholder="Popisek" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Heslo</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Heslo" required>
            </div>
            <div class="mb-3">
                <label for="is_admin" class="form-label">Správce</label>
                <input type="text" name="is_admin" id="is_admin" class="form-control" placeholder="Správce" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Přidat uživatele</button>
        </form>
    </main>

    <script src="bootstrap.bundle.js"></script>
</body>

</html>