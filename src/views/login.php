<?php

// Define variables and initialize with empty values
$username = $password = '';
$error = '';

if (!empty($_COOKIE['simplelogin_id']) && is_numeric($_COOKIE['simplelogin_id'])) {
    $result = $db->query("SELECT * FROM user WHERE id = '{$_COOKIE['simplelogin_id']}'");
    if ($user = $result->fetch_assoc()) {
        $_SESSION['user'] = $user;
        header('location: /');
        exit();
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
                  setcookie('simplelogin_id', $user['id'],time() + (30 * 24 * 60 * 60));
                } else {
                  if (isset($_COOKIE['simplelogin_id'])) {
                    setcookie('simplelogin_id','');
                  }
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
    <link rel="icon" href="misc/favicon.ico">
    <title>Login</title>
    <link href="misc/bootstrap.css" rel="stylesheet">
    <link href="misc/basic.css" rel="stylesheet">
    <link href="misc/login.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
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
  </body>
</html>
