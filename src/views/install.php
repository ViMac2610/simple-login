<?php

$host       = 'mysql';
$username   = 'root';
$password   = 'root';
$dbname     = 'db';

$db = new mysqli($host, $username, $password);
// Check connection
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// Create database.
if (!$db->select_db($dbname)) {
    die("Error selecting database': {$db->error}\n");
}

if ($db->select_db($dbname)) {
    // Create user table.
    $sql = "CREATE TABLE user (
        id int(11) NOT NULL AUTO_INCREMENT,
        username varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        role varchar(255) NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY username (username)
    )";

    if ($db->query($sql) === TRUE) {
        echo 'Table user created successfully';
    } else {
        echo 'Error creating table: ' . $db->error;
    }

    // Create item table.
    $sql = "CREATE TABLE item (
        id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        PRIMARY KEY (id)
    )";

    if ($db->query($sql) === TRUE) {
        echo 'Table item created successfully';
    } else {
        echo 'Error creating table: ' . $db->error;
    }

    // Create users.
    $sql = "INSERT INTO user (username, password, role)
        VALUES ('admin', '" . password_hash('admin', PASSWORD_DEFAULT) . "', 'admin'),
        VALUES ('user1', '" . password_hash('user1', PASSWORD_DEFAULT) . "', 'user'),
        VALUES ('user2', '" . password_hash('user2', PASSWORD_DEFAULT) . "', 'user'),
        VALUES ('user3', '" . password_hash('user3', PASSWORD_DEFAULT) . "', 'user'),
        VALUES ('guest1', '" . password_hash('guest1', PASSWORD_DEFAULT) . "', 'guest'),
        VALUES ('guest2', '" . password_hash('guest2', PASSWORD_DEFAULT) . "', 'guest')";

    if ($db->query($sql) === TRUE) {
        echo 'New users created successfully';
    } else {
        echo 'Error creating users: ' . $db->error;
    }

    // Create items.
    $sql = "INSERT INTO item (name)
        VALUES ('Book'),
        VALUES ('T-Shirt'),
        VALUES ('Chair'),
        VALUES ('Table'),
        VALUES ('Laptop'),
        VALUES ('Bottle'),
        VALUES ('I-Phone'),
        VALUES ('Refrigerator')";

    if ($db->query($sql) === TRUE) {
        echo 'New items created successfully';
    } else {
        echo 'Error creating items: ' . $db->error;
    }
}
$db->close();
