<?php
// Získání aktuální URL
$current_page = isset($_GET['url']) ? $_GET['url'] : 'dashboard/index';
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top w-100">
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
                            <a class="nav-link" href="index.php?url=login/logout">Odhlásit se</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?url=login/index">Přihlásit se</a>
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
                        <a href="index.php?url=dashboard/index" class="nav-link link-dark <?php echo $current_page == 'dashboard/index' ? 'active' : ''; ?>">
                            <span class="icon">
                                <i class="bi bi-easel"></i>
                            </span>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?url=items/index" class="nav-link link-dark <?php echo $current_page == 'items/index' ? 'active' : ''; ?>">
                            <span class="icon">
                                <i class="bi bi-card-list"></i>
                            </span>
                            Items
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?url=others/index" class="nav-link link-dark <?php echo $current_page == 'others/index' ? 'active' : ''; ?>">
                            <span class="icon">
                                <i class="bi bi-box"></i>
                            </span>
                            Others
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?url=user/index" class="nav-link link-dark <?php echo $current_page == 'user/index' ? 'active' : ''; ?>">
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