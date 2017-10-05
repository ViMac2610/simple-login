<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="misc/img/favicon.ico">
    <title>Home</title>
    <link href="misc/css/bootstrap.css" rel="stylesheet">
    <link href="misc/css/basic.css" rel="stylesheet">
  </head>
  <body>

    <?php include 'navbar.php'; ?>

    <div class="container">
      <div class="content">
        <div class="alert alert-success">You have been <strong>successfully logged in</strong>.</div>
        <a href="/logout" class="btn btn-default btn-lg btn-block">Logout</a>
        <?php include 'items.php'; ?>
      </div>
    </div>
  </body>
</html>
