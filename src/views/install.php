<?php

$error = $message = '';

if (!empty($_POST['install'])) {
    // Check connection
    if ($db->connect_error) {
        $error = "Connection failed: {$db->connect_error}.";
    }

    if ($db->select_db($dbname)) {
        // Reinstall.
        if ($_POST['install'] === 'Re-Install') {
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

            if ($db->query($sql) !== TRUE) {
                $error = "Error creating table user: {$db->error}.";
            }

            // Create users.
            $sql = "INSERT INTO user (username, password, role) VALUES
                ('admin', '" . password_hash('admin', PASSWORD_DEFAULT) . "', 'admin'),
                ('user1', '" . password_hash('user1', PASSWORD_DEFAULT) . "', 'user'),
                ('user2', '" . password_hash('user2', PASSWORD_DEFAULT) . "', 'user'),
                ('user3', '" . password_hash('user3', PASSWORD_DEFAULT) . "', 'user'),
                ('guest1', '" . password_hash('guest1', PASSWORD_DEFAULT) . "', 'guest'),
                ('guest2', '" . password_hash('guest2', PASSWORD_DEFAULT) . "', 'guest')";

            if ($db->query($sql) !== TRUE) {
                $error = "Error creating users: {$db->error}.";
            }
        }

        if(!$db->query('DESCRIBE item')) {
            // Create item table.
            $sql = "CREATE TABLE item (
                id int(11) NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                title varchar(255) NOT NULL,
                PRIMARY KEY (id)
            )";

            if ($db->query($sql) !== TRUE) {
                $error = "Error creating table item: {$db->error}.";
            }

            // Create items.
            $sql = "INSERT INTO item (name, title) VALUES
                ('phone', 'Phone'),
                ('monitor', 'Monitor'),
                ('scanner', 'Scanner'),
                ('printer-laser', 'Printer Laser'),
                ('floppy-disk', 'Floppy Disk'),
                ('optical-disk', 'Optical Disk'),
                ('hard-disk', 'Hard Disk'),
                ('webcam', 'Webcam'),
                ('audio-headset', 'Audio Headset'),
                ('camera-video', 'Camera Video'),
                ('mp3-player', 'Mp3 Player'),
                ('mouse', 'Mouse'),
                ('gamepad', 'Gamepad')";

            if ($db->query($sql) !== TRUE) {
                $error = "Error creating items: {$db->error}.";
            }
        }
    }
    else {
        $error = "Error selecting database': {$db->error}.";
    }
    $db->close();

    if (empty($error)) {
        $message = 'Install Completed!';
        $installed = true;
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="misc/img/favicon.ico">
    <title>Install</title>
    <link href="misc/css/bootstrap.css" rel="stylesheet">
    <link href="misc/css/font-awesome.css" rel="stylesheet">
    <link href="misc/css/basic.css" rel="stylesheet">
  </head>

  <body>

    <?php include 'navbar.php'; ?>

    <main role="main" class="container">

      <div class="content">
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php print $error; ?></div>
        <?php endif; ?>
        <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?php print $message; ?></div>
        <?php endif; ?>

        <form class="form-install" action="/install" method="post">
          <?php if (!$installed): ?>
            <p>System is not installed, click here to install <input type="submit" class="btn btn-primary" name="install" value="Install"></input></p>
          <?php endif; ?>
          <?php if ($installed): ?>
            <p>System is installed, click here to fully re-install <input type="submit" class="btn btn-primary" name="install" value="Re-Install"></input> or <a href="/" class="btn btn-primary"><i class="fa fa-home"></i> Take Me Home</a></p>
          <?php endif; ?>
        </form>
      </div>

    </main>
    <script src="misc/js/jquery.js"></script>
    <script src="misc/js/popper.js"></script>
    <script src="misc/js/bootstrap.js"></script>
  </body>
</html>
