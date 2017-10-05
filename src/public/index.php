<?php

session_start();

require_once '../config/config.php';

$db = new mysqli($host, $username, $password);

$loggedin = !empty($_SESSION['user']);
$installed = $db->select_db($dbname) && $db->query('DESCRIBE user') && $db->query('DESCRIBE item');

// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

if (!$installed && $request_uri[0] !== '/install') {
    header('Location: /install');
    exit();
}

// Route it up!
switch ($request_uri[0]) {
    // Home page
    case '/':
        if (!$loggedin) {
            header('Location: /login');
            exit();
        }
        require_once '../views/home.php';
        break;
    // Install page
    case '/install':
        require_once '../views/install.php';
        break;
    // Login page
    case '/login':
        if ($loggedin) {
            header('Location: /');
            exit();
        }
        require_once '../views/login.php';
        break;
    // Logout page
    case '/logout':
        if (!$loggedin) {
            header('Location: /login');
            exit();
        }
        require_once '../views/logout.php';
        break;
    // Everything else
    default:
        header('HTTP/1.0 404 Not Found');
        require_once '../views/404.php';
        break;
}
