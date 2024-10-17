<?php
session_start();
require "assets/database.php";
require "assets/zak.php";
$connection = connectionDB();

$last_logged_in_users = [];
if (file_exists('logins.json')) {
    $last_logged_in_users = json_decode(file_get_contents('logins.json'), true);
}


if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Smazání uživatele
if (isset($_POST['delete_user'])) {
    $email_to_delete = $_POST['email'];
    $last_logged_in_users = array_filter($last_logged_in_users, function ($user) use ($email_to_delete) {
        return $user['email'] !== $email_to_delete;
    });
    file_put_contents('logins.json', json_encode($last_logged_in_users));
    header("Location: dashboard.php");
    exit();
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./bootstrap-icons.css">
</head>
<style>
    body {
        padding-top: 50px;
        /* Odsazení pro pevné záhlaví */
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
    }

    .sidebar-sticky {
        height: calc(100vh - 48px);
        overflow-x: hidden;
        overflow-y: auto;
    }
</style>

<body>
    <header> <?php require "assets/header.php"; ?> </header>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
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
                        <th>Heslo</th>
                        <th>Je Správce</th>
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
                            <td><?php echo htmlspecialchars($user["password"]); ?></td>
                            <td><?php echo htmlspecialchars($user["is_admin"]); ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>


        <section class="mt-5">
            <h2>Simple form example</h2>

            <form class="row g-3">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">State</label>
                    <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </form>
        </section>


        <section class="mt-5">
            <h2>Notifications examples</h2>
            <div class="alert alert-success" role="alert">
                A simple success alert—check it out!
            </div>
            <div class="alert alert-danger" role="alert">
                A simple danger alert—check it out!
            </div>
            <div class="alert alert-info" role="alert">
                A simple info alert—check it out!
            </div>
        </section>


        <section class="mt-5">
            <h2>Badge examples</h2>
            <span class="badge text-bg-primary op-33">Primary</span>
            <span class="badge text-bg-secondary">Secondary</span>
            <span class="badge text-bg-success">Success</span>
            <span class="badge text-bg-danger">Danger</span>
            <span class="badge text-bg-warning">Warning</span>
            <span class="badge text-bg-info">Info</span>
            <span class="badge text-bg-light">Light</span>
            <span class="badge text-bg-dark">Dark</span>
        </section>


        <section class="mt-5">
            <h2>Button examples</h2>
            <button type="button" class="btn btn-primary">Primary</button>
            <button type="button" class="btn btn-secondary">Secondary</button>
            <button type="button" class="btn btn-success">Success</button>
            <button type="button" class="btn btn-danger">Danger</button>
            <button type="button" class="btn btn-warning">Warning</button>
            <button type="button" class="btn btn-info">Info</button>
            <button type="button" class="btn btn-light">Light</button>
            <button type="button" class="btn btn-dark">Dark</button>
        </section>


        <section class="mt-5">
            <h2>Others</h2>
            <button type="button" class="btn btn-primary position-relative">
                Inbox
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    99+
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>
        </section>

        <!-- Pagination component -->
        <nav aria-label="Page navigation example" class="mt-5 mid">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span class="sr-only">Next</span>
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </main>
    </div>
    </div>
    <script src="./bootstrap.js"></script>
</body>

</html>