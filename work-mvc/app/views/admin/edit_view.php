<?php
$id = $data['task']['id'];
$username = $data['task']['username'];
$email = $data['task']['email'];
$text = $data['task']['text'];
$done = $data['task']['done'] == 1 ? 'checked' : '';
?>

<div class="container mt-3">
  <h1 class='text-center'>Edit Todo</h1>

  <form class='mt-3' action="/admin/update" method="POST">
    <div class="form-group mb-2">
      <input type="hidden" name="id" value=<?= $id ?>>
    </div>

    <div class="d-flex flex-column mb-3">
      <h4 class='text-muted mr-2'>Username: <?= $username ?></h4>
      <h4 class='text-muted mr-2'>Email: <?= $email ?></h4>
    </div>

    <div class="form-group mb-2">
      <input type="text" class="form-control" placeholder="Text" name="text" value=<?= $text ?>>
      <?php if ($text == '') : ?>
        <small class="form-text text-muted error">Invalid Text.</small>
      <?php endif; ?>
    </div>

    <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="done" name="done" <?= $done ?>>
      <label class="form-check-label" for="done">Done</label>
    </div>

    <div class="d-flex justify-content-between">
      <a href="/admin" class="btn btn-outline-info">Back To Main Page</a>
      <button class="btn btn-outline-success">Edit</button>
    </div>
  </form>
</div>