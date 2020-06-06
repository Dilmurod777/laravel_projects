<?php
$valid = is_null($data['valid']) ? true : $data['valid'];
$username = $data['errors']['username'];
$email = $data['errors']['email'];
$text = $data['errors']['text'];
?>

<div class="container mt-3">
  <h1 class='text-center'>Create Todo</h1>

  <form class='mt-3' action="/main/store" method="POST">
    <div class="form-group mb-2">
      <input type="text" class="form-control" placeholder="Username" name="username" value=<?= $username['value'] ?>>
      <?php if (!$valid && $username['value'] == false) : ?>
        <small class="form-text text-muted error"><?= $username['message'] ?></small>
      <?php endif; ?>
    </div>

    <div class="form-group mb-2">
      <input type="text" class="form-control" placeholder="E-mail" name="email" value=<?= $email['value'] ?>>
      <?php if (!$valid && $email['value'] == false) : ?>
        <small class="form-text text-muted error"><?= $email['message'] ?></small>
      <?php endif; ?>
    </div>

    <div class="form-group mb-2">
      <input type="text" class="form-control" placeholder="Text" name="text" value=<?= $text['value'] ?>>
      <?php if (!$valid && $text['value'] == false) : ?>
        <small class="form-text text-muted error"><?= $text['message'] ?></small>
      <?php endif; ?>
    </div>

    <div class="d-flex justify-content-between">
      <a href="/" class="btn btn-outline-info">Back To Main Page</a>
      <button class="btn btn-outline-success">Create</button>
    </div>
  </form>
</div>