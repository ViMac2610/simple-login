<?php

$error = $message = '';
$deleted = false;
$item = null;

if ($_SESSION['user']['role'] !== 'admin') {
    $error = 'You do not have permission to delete this item.';
}

if (empty($error) && empty($_POST['delete'])) {
    if (!is_numeric($_GET['id'])) {
        $error = 'Invalid item id.';
    }
    else {
        $result = $db->query("SELECT * FROM item WHERE id = '{$_GET['id']}'");
        if (!$item = $result->fetch_assoc()) {
            $error = "No item found with id: {$_GET['id']}.";
        }
    }
}

if (empty($error) && !empty($_POST['delete'])) {
    if (!is_numeric($_POST['id'])) {
        $error = 'Invalid item id.';
    }
    else {
        $deleted = $db->query("DELETE FROM item WHERE id = '{$_POST['id']}'");
        if ($deleted) {
            $message = 'Delete item successfully!';
        }
        else {
            $error = "Can not delete item with id: {$_POST['id']}.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="misc/img/favicon.ico">
    <title>Delete</title>
    <link href="misc/css/bootstrap.css" rel="stylesheet">
    <link href="misc/css/font-awesome.css" rel="stylesheet">
    <link href="misc/css/basic.css" rel="stylesheet">
  </head>
  <body>

    <?php include 'navbar.php'; ?>

    <div class="container">
      <div class="content">
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php print $error; ?></div>
        <?php endif; ?>
        <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?php print $message; ?></div>
        <?php endif; ?>

        <?php if (!empty($error) || !empty($message)): ?>
        <p><a href="/" class="btn btn-primary"><i class="fa fa-home"></i> Take Me Home</a></p>
        <?php endif; ?>

        <?php if (!empty($item)): ?>
        <form class="form-delete" action="/delete" method="post">
          <input name="id" type="hidden" value="<?= $item['id'] ?>">
          <div class="alert alert-danger">Do you want to delete item <strong><?= $item['title'] ?></strong>?</div>
          <input type="submit" class="btn btn-primary" name="delete" value="Delete"></input> or <a href="/" class="btn btn-primary"><i class="fa fa-home"></i> Take Me Home</a>
        </form>
        <?php endif; ?>
      </div>
    </div>
  </body>
</html>
