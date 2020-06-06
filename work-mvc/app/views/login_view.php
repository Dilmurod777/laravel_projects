<?php
$error = $data['error'];
?>

<div class="container mt-3">
  <h1 class='text-center'>Login</h1>

  <?php if ($error) : ?>
    <div class="alert alert-danger" role="alert">
      Authentication failed!
    </div>
  <?php endif; ?>

  <form action="/login/login" method='POST'>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name='username'>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name='password'>
    </div>

    <div class="d-flex justify-content-between align-items-center">
      <button class="btn btn-primary">Submit</button>
      <a href="/" class="btn btn-outline-info">Back To Main Page</a>
    </div>
  </form>
</div>