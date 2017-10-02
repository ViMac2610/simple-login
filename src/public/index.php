<?php
// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Route it up!
switch ($request_uri[0]) {
    // Home page
    case '/':
        require '../views/home.php';
        break;
    // Install page
    case '/install':
        require '../views/install.php';
        break;
    // Login page
    case '/login':
        require '../views/login.php';
        break;
    // Logout page
    case '/logout':
        require '../views/logout.php';
        break;
    // Everything else
    default:
        header('HTTP/1.0 404 Not Found');
        require '../views/404.php';
        break;
}
