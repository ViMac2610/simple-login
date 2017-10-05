<?php

$result = $db->query('SELECT * FROM item');
$items = $result->fetch_all(MYSQLI_ASSOC);

?>

<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Name</th>
      <th>Image</th>
      <?php if ($_SESSION['user']['role'] === 'admin'): ?>
      <th>Action</th>
      <?php endif; ?>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($items as $item): ?>
    <tr>
      <th><?= $item['id'] ?></th>
      <td><?= $item['title'] ?></td>
      <td><?= $item['name'] ?></td>
      <td><img src="misc/img/<?= $item['name'] ?>.png" alt="<?= $item['name'] ?>" style="width: 32px;height: 32px;"></td>
      <?php if ($_SESSION['user']['role'] === 'admin'): ?>
      <td><a href="delete?id=<?= $item['id'] ?>">Delete</a></td>
      <?php endif; ?>
    </tr>
  <?php endforeach ?>
  </tbody>
</table>
