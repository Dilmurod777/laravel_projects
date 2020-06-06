<?php

class Error_Controller extends Controller
{
  
  function __construct()
  {
    parent::__construct();
  }

  # index page -> main page
  function index_action()
  {
    $this->view->generate('error_view.php', 'template_view.php');
  }
}
