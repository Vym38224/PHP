<!doctype html>
<html lang="en">

<head>
    <title>Odstranit uživatele</title>
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
        <h1 class="pb-3 border-bottom">Odstranit uživatele</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Odstranit uživatele</h5>
                <p class="card-text">Jste si jisti, že chcete tohoto uživatele odstranit?</p>
                <form method="POST" action="index.php?url=user/delete">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <button type="submit" class="btn btn-danger">Odstranit</button>
                    <a href="index.php?url=user/index" class="btn btn-secondary">Zrušit</a>
                </form>
            </div>
        </div>
    </main>

    <script src="bootstrap.bundle.js"></script>
</body>

</html>