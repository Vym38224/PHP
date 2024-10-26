<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
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
        <h1 class="pb-3 border-bottom">Dashboard</h1>
        <section>
            <h2>Výpis posledních 10 přihlášených uživatelů</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Jméno</th>
                        <th>Příjmení</th>
                        <th>E-mail</th>
                        <th>Telefon</th>
                        <th>Pracovna</th>
                        <th>Popis</th>
                        <th>Je Správce</th>
                        <th>Čas přihlášení</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($last_logged_in_users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user["first_name"]); ?></td>
                            <td><?php echo htmlspecialchars($user["last_name"]); ?></td>
                            <td><?php echo htmlspecialchars($user["email"]); ?></td>
                            <td><?php echo htmlspecialchars($user["mobile"]); ?></td>
                            <td><?php echo htmlspecialchars($user["room"]); ?></td>
                            <td><?php echo htmlspecialchars($user["life"]); ?></td>
                            <td><?php echo htmlspecialchars($user["is_admin"]); ?></td>
                            <td><?php echo htmlspecialchars($user["login_time"]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script src="bootstrap.bundle.js"></script>
</body>

</html>