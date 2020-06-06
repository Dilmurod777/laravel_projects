<?php

class Login_Controller extends Controller
{
  private $ADMIN_USERNAME='admin';
  private $ADMIN_PASSWORD='123';

  function __construct()
  {
    parent::__construct();
  }

  # index page
  function index_action()
  {
    # if authenticated go to admin page
    if (isset($_SESSION['auth']) && $_SESSION['auth']) {
      header('Location: ' . '/admin');
      die();
    } else {
      # else demonstrate errors on login page
      $error = array_key_exists('error', $_GET) ? $_GET['error'] : false;
      $this->view->generate('login_view.php', 'template_view.php', compact('error'));
    }
  }

  # login function
  function login_action()
  {
    # get username and password
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

    # default values for admin username and password checking
    if ($username == $this->ADMIN_USERNAME && $password == $this->ADMIN_PASSWORD) {
      $_SESSION['auth'] = true; # save session for authentication
      header('Location: ' . '/admin'); # go to admin page
      die();
    } else {
      # if wrong credentials entered, go to login page with errors
      header('Location: ' . '/login/index?error=true');
      die();
    }
  }

  # logout function
  function logout_action()
  {
    # destroy all sessions
    session_destroy();
    header('Location: ' . '/login'); # go to login page
    die();
  }
}
