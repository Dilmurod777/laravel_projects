<?php
$tasks = $data['data'];
$page = $data['page'];
$orderBy = $data['orderBy'];
$asc = $data['asc'] ? 'true' : 'false';
$previous = $data['previous'];
$next = $data['next'];
$success = array_key_exists('success', $_GET) ? $_GET['success'] : false;
$core = in_array('admin', explode('\\', __DIR__)) ? 'admin' : 'main';
?>

<div class="container mt-3">
  <nav class="navbar">
    <div class="d-flex align-item-center justify-content-start mt-2">
      <p class="navbar-brand m-0 mr-3">Your Todos</p>
      <a href="/login" class="btn btn-info">Login</a>
    </div>

    <a class="btn btn-info ml-5 mr-0 btn-create" href="/main/create">Create</a>
  </nav>

  <?php if ($success) : ?>
    <div class="alert alert-success" role="alert">
      Task added!
    </div>
  <?php endif; ?>

  <div class="btn-group" role="group" aria-label="Basic example">
    <a class="btn btn-light text-dark border" href="/main/index?page=<?= $page ?>&orderBy=username&asc=true">Username &uarr;</a>
    <a class="btn btn-light text-dark border" href="/main/index?page=<?= $page ?>&orderBy=username&asc=false">Username &darr;</a>
    <a class="btn btn-light text-dark border" href="/main/index?page=<?= $page ?>&orderBy=email&asc=true">Email &uarr;</a>
    <a class="btn btn-light text-dark border" href="/main/index?page=<?= $page ?>&orderBy=email&asc=false">Email &darr;</a>
    <a class="btn btn-light text-dark border" href="/main/index?page=<?= $page ?>&orderBy=done&asc=false">Status &#9745;</a>
    <a class="btn btn-light text-dark border" href="/main/index?page=<?= $page ?>&orderBy=done&asc=true">Status &#9746;</a>
  </div>

  <div class="mt-4">
    <?php if (empty($tasks)) : ?>
      <h3 class="text-muted">No tasks</h3>
    <?php else : ?>
      <?php foreach ($tasks as $task) : ?>
        <div class="card mb-2">
          <div class="card-body">
            <div class="d-flex justify-content-start align-items-center mb-3">
              <h4 class="card-title mb-0"><?= $task['text'] ?></h4>
              <?php if ($task['done'] == 1) : ?>
                <h1 class="badge badge-success mb-0 ml-2">Выполнено</h1>
              <?php endif; ?>
              <?php if ($task['modified'] == 1) : ?>
                <h1 class="badge badge-info mb-0 ml-2">Отредактировано администратором</h1>
              <?php endif; ?>
            </div>
            <div class="d-flex justify-content-start">
              <h6 class="card-subtitle mb-2 mr-2 text-muted"><?= $task['username'] ?></h6>
              <h6 class="card-subtitle mb-2 mr-2 text-muted">|</h6>
              <h6 class="card-subtitle mb-2 mr-2 text-muted"><?= $task['email'] ?></h6>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <?php include __DIR__ . '/common/pagination_view.php' ?>
  </div>
</div>