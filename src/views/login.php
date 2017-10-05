<?php

// Define variables and initialize with empty values
$username = $password = '';
$error = '';

if (!empty($_COOKIE['simplelogin_id']) && is_numeric($_COOKIE['simplelogin_id']) && !empty($_COOKIE['simplelogin_secret_id'])) {
    $secretKey = getenv('SECRET_KEY');
    if (password_verify("{$secretKey}:{$_COOKIE['simplelogin_id']}", $_COOKIE['simplelogin_secret_id'])) {
      $id = $db->escape_string($_COOKIE['simplelogin_id']);
      $result = $db->query("SELECT * FROM user WHERE id = '{$id}'");
      if ($user = $result->fetch_assoc()) {
          $_SESSION['user'] = $user;
          header('location: /');
          exit();
      }
    } else {
      setcookie('simplelogin_id', '', time() - 3600);
      setcookie('simplelogin_secret_id', '', time() - 3600);
    }
}

if (!empty($_POST['login'])) {
    // Check if username is empty.
    if (empty(trim($_POST['username'])) && empty($error)) {
        $error = 'Please enter username.';
    } else {
        $username = trim($_POST['username']);
    }

    // Check if password is empty.
    if(empty(trim($_POST['password'])) && empty($error)){
        $error = 'Please enter your password.';
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($error)) {
        $username = $db->escape_string($username);
        $result = $db->query("SELECT * FROM user WHERE username = '{$username}'");
        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                if (!empty($_POST['remember-me'])) {
                  $expire = time() + (30 * 24 * 60 * 60);
                  $secretKey = getenv('SECRET_KEY');
                  setcookie('simplelogin_id', $user['id'], $expire);
                  setcookie('simplelogin_secret_id', password_hash("{$secretKey}:{$user['id']}", PASSWORD_DEFAULT), $expire);
                } else if (isset($_COOKIE['simplelogin_id']) || $_COOKIE['simplelogin_secret_id']) {
                  setcookie('simplelogin_id', '', time() - 3600);
                  setcookie('simplelogin_secret_id', '', time() - 3600);
                }
                $_SESSION['user'] = $user;
                header('location: /');
                exit();
            }
            else {
                $error = 'Invalid password';
            }
        } else {
          $error = 'Invalid username';
        }
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="misc/img/favicon.ico">
    <title>Login</title>
    <link href="misc/css/bootstrap.css" rel="stylesheet">
    <link href="misc/css/basic.css" rel="stylesheet">
    <link href="misc/css/login.css" rel="stylesheet">
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <div class="container">
      <div class="content">
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php print $error; ?></div>
        <?php endif; ?>

        <form class="form-signin" action="/login" method="post">
          <h2 class="form-signin-heading">Please sign in</h2>
          <label for="username" class="sr-only">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
          <label for="password" class="sr-only">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="remember-me" value="true"> Remember me
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" name="login" value="true" type="submit">Sign in</button>
        </form>
      </div>

    </div>
  </body>
</html>
