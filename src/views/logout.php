<?php

// Initialize the session.
session_start();

// Deleting cookie by setting expirty to past time.
setcookie('simplelogin_id', '', time() - 3600);

// Destroy the session.
session_destroy();

// Redirect to login page.
header('location: /login');
