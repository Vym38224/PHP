<?php
// Získání cesty z URL
$path = isset($_GET['path']) ? $_GET['path'] : '';

// Kontrola, zda soubor existuje
if ($path && file_exists($path . '.php')) {
    require $path . '.php';
} else {
    // Zobrazení chybové stránky 404
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>Stránka, kterou hledáte, neexistuje.</p>";
}
