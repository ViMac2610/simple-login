<?php

echo 'Reinstalling...<br>';

// Check connection
if ($db->connect_error) {
    die("Connection failed: {$db->connect_error}\n");
}

if ($db->select_db($dbname)) {
    // Reinstall.
    if (isset($_GET['reinstall']) && $_GET['reinstall'] === 'yes') {
        $db->query('DROP TABLE IF EXISTS user');
        $db->query('DROP TABLE IF EXISTS item');
    }

    if(!$db->query('DESCRIBE user')) {
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
            echo 'Table user created successfully<br>';
        } else {
            echo "Error creating table: {$db->error}<br>";
        }

        // Create users.
        $sql = "INSERT INTO user (username, password, role) VALUES
            ('admin', '" . password_hash('admin', PASSWORD_DEFAULT) . "', 'admin'),
            ('user1', '" . password_hash('user1', PASSWORD_DEFAULT) . "', 'user'),
            ('user2', '" . password_hash('user2', PASSWORD_DEFAULT) . "', 'user'),
            ('user3', '" . password_hash('user3', PASSWORD_DEFAULT) . "', 'user'),
            ('guest1', '" . password_hash('guest1', PASSWORD_DEFAULT) . "', 'guest'),
            ('guest2', '" . password_hash('guest2', PASSWORD_DEFAULT) . "', 'guest')";

        if ($db->query($sql) === TRUE) {
            echo 'New users created successfully<br>';
        } else {
            echo "Error creating users: {$db->error}<br>";
        }
    }

    if(!$db->query('DESCRIBE item')) {
        // Create item table.
        $sql = "CREATE TABLE item (
            id int(11) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            PRIMARY KEY (id)
        )";

        if ($db->query($sql) === TRUE) {
            echo 'Table item created successfully<br>';
        } else {
            echo "Error creating table: {$db->error}<br>";
        }

        // Create items.
        $sql = "INSERT INTO item (name) VALUES
            ('Book'),
            ('T-Shirt'),
            ('Chair'),
            ('Table'),
            ('Laptop'),
            ('Bottle'),
            ('I-Phone'),
            ('Refrigerator')";

        if ($db->query($sql) === TRUE) {
            echo 'New items created successfully<br>';
        } else {
            echo "Error creating items: {$db->error}<br>";
        }
    }
}
else {
    die("Error selecting database': {$db->error}<br>");
}
$db->close();

echo 'Completed!<br>';
