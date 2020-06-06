<nav class="d-flex justify-content-center mt-3">
  <ul class="pagination">
    <?php if ($previous) : ?>
      <li class="page-item">
        <a class="page-link" href="/<?= $core ?>/index?page=<?= $page - 1 ?>&orderBy=<?= $orderBy ?>&asc=<?= $asc ?>">
          Previous
        </a>
      </li>
      <li class="page-item">
        <a class="page-link" href="/<?= $core ?>/index?page=<?= $page - 1 ?>&orderBy=<?= $orderBy ?>&asc=<?= $asc ?>">
          <?php echo ($page - 1) ?>
        </a>
      </li>
    <?php endif; ?>

    <?php if ($previous || $next) : ?>
      <li class="page-item active">
        <a class="page-link" href="/<?= $core ?>/index?page=<?= $page ?>&orderBy=<?= $orderBy ?>&asc=<?= $asc ?>">
          <?php echo $page ?>
        </a>
      </li>
    <?php endif; ?>


    <?php if ($next) : ?>
      <li class="page-item">
        <a class="page-link" href="/<?= $core ?>/index?page=<?= $page + 1 ?>&orderBy=<?= $orderBy ?>&asc=<?= $asc ?>">
          <?php echo $page + 1 ?>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="/<?= $core ?>/index?page=<?= $page + 1 ?>&orderBy=<?= $orderBy ?>&asc=<?= $asc ?>">
          Next
        </a>
      </li>
    <?php endif; ?>
  </ul>
</nav>