<?php
// Získání aktuální URL
$current_page = basename($_SERVER['REQUEST_URI']);
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Administrace</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION["username"])): ?>
                        <li class="nav-item">
                            <span class="nav-link">Přihlášen jako: <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Odhlásit se</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Přihlásit se</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link link-dark <?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>">
                            <span class="icon">
                                <i class="bi bi-easel"></i>
                            </span>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="items.php" class="nav-link link-dark <?php echo $current_page == 'items.php' ? 'active' : ''; ?>">
                            <span class="icon">
                                <i class="bi bi-card-list"></i>
                            </span>
                            Items
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="others.php" class="nav-link link-dark <?php echo $current_page == 'others.php' ? 'active' : ''; ?>">
                            <span class="icon">
                                <i class="bi bi-box"></i>
                            </span>
                            Others
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="users.php" class="nav-link link-dark <?php echo $current_page == 'users.php' ? 'active' : ''; ?>">
                            <span class="icon">
                                <i class="bi bi-people"></i>
                            </span>
                            Users
                        </a>
                    </li>
                    <!-- Přidejte další položky menu podle potřeby -->
                </ul>
            </div>
        </nav>
    </div>
</div>