<?php

class Main_Controller extends Controller
{
  function __construct()
  {
    parent::__construct();
    $this->model = new Main_Model();
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

    # extract the orderBy to show, default is 'id'
    if (array_key_exists('orderBy', $_GET)) {
      $orderBy = $_GET['orderBy'];
    } else {
      $orderBy = 'id';
    }

    # extract asc or desc to show, default is asc
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
    $this->view->generate('main_view.php', 'template_view.php', compact('data', 'page', 'previous', 'next', 'orderBy', 'asc'));
  }

  # create page
  function create_action()
  {
    # check if there are some errors
    $errors = $this->checkErrors();

    if ($errors['valid']) {
      # if there are no errors, then go to create view without errors
      $this->view->generate('create_view.php', 'template_view.php');
    } else {
      # if there are errors, then go to create view with errors
      $this->view->generate('create_view.php', 'template_view.php', $errors);
    }
  }

  # store new task function
  function store_action()
  {
    $errorsExist = false;
    $errorsUrl = '/main/create?valid=false';

    # extract sent data
    $data = [
      'username' => htmlspecialchars($_POST['username'], ENT_QUOTES),
      'email' => htmlspecialchars($_POST['email'], ENT_QUOTES),
      'text' => htmlspecialchars($_POST['text'], ENT_QUOTES)
    ];

    # find if inputs are empty or not
    if (trim($data['username']) == '' || trim($data['email']) == '' || trim($data['text']) == '') {
      $errorsExist = true;
    }

    # find if email has correct format
    if (!filter_var(trim($data['email']), FILTER_VALIDATE_EMAIL)) {
      $errorsExist = true;
      $errorsUrl .= "&email=";
    } else {
      $errorsUrl .= "&email={$data['email']}";
    }

    $errorsUrl .= "&username={$data['username']}&text={$data['text']}";

    # if there are errors, go to create page with errors
    if ($errorsExist) {
      header('Location: ' . $errorsUrl);
      die();
    }

    # if no errors with inputs, insert sent data to database
    if ($this->model->insert_data($data)) {
      # if successful, go to index page
      header('Location: ' . '/main/index?page=1&success=true');
      die();
    } else {
      # if not, go to error page
      header('Location: ' . '/error');
      die();
    }
  }

  # check for errors sent to create page
  function checkErrors()
  {
    // var_dump($_GET);
    $data = ['valid' => true];
    if (!empty($_GET)) {
      if ($_GET['valid'] == 'false') {
        $data['valid'] = false;
        $username = $_GET['username'];
        $email = $_GET['email'];
        $text = $_GET['text'];

        if ($username == '') {
          $data['errors']['username']['value'] = false;
          $data['errors']['username']['message'] = 'Invalid Username.';
        } else {
          $data['errors']['username']['value'] = $username;
        }

        if ($email == '') {
          $data['errors']['email']['value'] = false;
          $data['errors']['email']['message'] = 'Invalid Email.';
        } else {
          $data['errors']['email']['value'] = $email;
        }

        if ($text == '') {
          $data['errors']['text']['value'] = false;
          $data['errors']['text']['message'] = 'Invalid Text.';
        } else {
          $data['errors']['text']['value'] = $text;
        }
      }
    }

    return $data;
  }
}
