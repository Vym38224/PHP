<?php
// Získání aktuální URL
$current_page = basename($_SERVER['REQUEST_URI']);
?>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <button class="navbar-toggler d-md-none collapsed m-2 b-0" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">simple administration</a>

    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="#">logout</a>
        </div>
    </div>
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