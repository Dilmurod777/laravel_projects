<?php

class Route
{
  static function start()
  {
    $controller_name = 'Main'; # default controller
    $action_name = 'index'; # default action

    session_start(); # start session for auth checking

    $routes = preg_split('(/|\?)', $_SERVER['REQUEST_URI']); # separate the route URL

    if (!empty($routes[1])) {
      $controller_name = $routes[1]; # extract controller name
    }

    # if controller is admin, check for auth existance
    if ($controller_name == 'admin') {
      # $_SESSION['auth'] is required for authorization
      if (!isset($_SESSION['auth'])) {
        header('Location: ' . '/login/index?error=true');
        die();
      }
    }

    if (!empty($routes[2])) {
      $action_name = $routes[2]; # extract action 
    }

    # append prefixes for controller, model and action
    $model_name = $controller_name . '_Model'; // ex: Task_Model
    $controller_name = $controller_name . '_Controller'; // ex: Task_Controller
    $action_name = $action_name . '_action'; # ex: index_action

    # find the model file
    $model_file = strtolower($model_name) . '.php'; # ex: task_model.php
    $model_path = "app/models/" . $model_file;
    if (file_exists($model_path)) {
      include "app/models/" . $model_file;
    }

    // find controller file
    $controller_file = strtolower($controller_name) . '.php'; # ex: task_controller.php
    $controller_path = "app/controllers/" . $controller_file;
    if (file_exists($controller_path)) {
      include "app/controllers/" . $controller_file;
    } else {
      # if there is no controller found
      Route::ErrorPage404();
    }

    // create a new controller
    $controller = new $controller_name;
    $action = $action_name;


    if (method_exists($controller, $action)) {
      $controller->$action(); # call action of controller if there is one
    } else {
      Route::ErrorPage404(); # IF the is no such action
    }
  }

  # error routing
  static function ErrorPage404()
  {
    $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    header('HTTP/1.1 404 Not Found');
    header("Status: 404 Not Found");
    header('Location:' . $host . 'error');
  }
}
