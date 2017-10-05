<?php

$result = $db->query('SELECT * FROM item');
$items = $result->fetch_all(MYSQLI_ASSOC);

?>

<table>
  <tr>
    <th>Title</th>
    <th>Name</th>
    <th>Image</th>
    <th>Action</th>
  </tr>
<?php foreach ($items as $item): ?>
  <tr>
    <td><?= $item['title'] ?></td>
    <td><?= $item['name'] ?></td>
    <td><img src="misc/img/<?= $item['name'] ?>.png" alt="<?= $item['name'] ?>" style="width: 32px;height: 32px;"></td>
    <td><a href="delete?id=<?= $item['id'] ?>">Delete</a></td>
  </tr>
<?php endforeach ?>
</table>
