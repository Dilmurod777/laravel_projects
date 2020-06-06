<?php
$tasks = $data['data'];
$page = $data['page'];
$orderBy = $data['orderBy'];
$asc = $data['asc'] ? 'true' : 'false';
$previous = $data['previous'];
$next = $data['next'];
$core = in_array('admin', explode('\\', __DIR__)) ? 'admin' : 'main';
?>


<div class="container">
  <nav class="navbar">
    <div class="d-flex align-item-center justify-content-start mt-2">
      <p class="navbar-brand m-0 mr-3">Todos</p>
    </div>

    <div>
      <a class="btn btn-info ml-2 mr-0 btn-create" href="/">Main Page</a>
      <a class="btn btn-danger ml-2 mr-0 btn-create" href="/login/logout">Logout</a>
    </div>
  </nav>

  <div class="mt-4">
    <?php if (empty($tasks)) : ?>
      <h3 class="text-muted">No tasks</h3>
    <?php else : ?>
      <?php foreach ($tasks as $task) : ?>
        <div class="card mb-2">
          <div class="card-body d-flex .flex-column justify-content-between align-items-center">
            <div>
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

            <div>
              <a href="/admin/edit?id=<?= $task['id'] ?>" class="btn btn-info">Edit</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <?php include __DIR__ . '\..\common\pagination_view.php' ?>
  </div>
</div>