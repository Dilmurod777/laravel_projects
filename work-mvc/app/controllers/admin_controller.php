<?php

class Admin_Controller extends Controller
{
  function __construct()
  {
    parent::__construct();
    $this->model = new Admin_Model(); # admin model
  }

  # index page -> main page
  function index_action()
  {
    # extract the page to show, default is 1
    if (array_key_exists('page', $_GET)) {
      $page = intval($_GET['page']);
    } else {
      $page = 1;
    }

    # extract the order of tasks, default is 'id'
    if (array_key_exists('orderBy', $_GET)) {
      $orderBy = $_GET['orderBy'];
    } else {
      $orderBy = 'id';
    }

    # extract asc or desc, default is asc
    if (array_key_exists('asc', $_GET)) {
      $asc = $_GET['asc'] == 'true' ? 'asc' : 'desc';
    } else {
      $asc = 'asc';
    }
    # get all tasks, if there is previoius or next pages  
    $result = $this->model->get_all($page, $orderBy, $asc);
    $data = $result['data'];
    $previous = $result['previous'];
    $next = $result['next'];

    # if data is not received
    if ($data === false) {
      header('Location: ' . '/error');
      die();
    }

    $asc = $asc == 'asc' ? true : false;
    $this->view->generate('admin/main_view.php', 'template_view.php', compact('data', 'page', 'previous', 'next', 'orderBy', 'asc'));
  }

  # edit page
  function edit_action()
  {
    # if there was not provided $id, return error page
    if (!isset($_GET['id'])) {
      header('Location: ' . '/error');
      die();
    }

    # get id from $_GET array (URL)
    $id = intval($_GET['id']);
    # get task with $id
    $task = $this->model->getTaskById($id)['data'];

    # display view with certain data
    $this->view->generate('admin/edit_view.php', 'template_view.php', compact('task'));
  }

  # update function
  function update_action()
  {
    # get id of task
    $id = $_POST['id'];
    # create array of updated values
    $data = [
      'text' => htmlspecialchars($_POST['text'], ENT_QUOTES),
      'done' => $_POST['done'] == 'on' ? 1 : 0
    ];

    # update database
    if ($this->model->update_data($id, $data)) {
      # if successful, go to main page
      header('Location: ' . '/admin/index');
      die();
    } else {
      # if not successful, go to error page
      header('Location: ' . '/error');
      die();
    }
  }
}
