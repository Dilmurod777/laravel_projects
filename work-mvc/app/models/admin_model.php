<?php

class Admin_Model extends Model
{
  public $tasksPerPage = 5; # 5 tasks per page

  function __construct()
  {
    parent::__construct();
    $this->findTotalRows(); # detemine number of tasks
  }

  # get all tasks function
  function get_all($page, $orderBy, $asc)
  {
    $offset = ($page - 1) * $this->tasksPerPage; # starting index of task
    try {
      # sql query -> get rows from $offset till $offset + $tasksPerPage 
      $sql = "SELECT * FROM $this->table ORDER BY $orderBy $asc LIMIT $this->tasksPerPage OFFSET $offset";

      # create prepare statements
      $stmt = $this->conn->prepare($sql);
      # execute prepare statements
      $stmt->execute();
      # return tasks in form of Associative array
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      # get all tasks
      $data = $stmt->fetchAll();
      # keep total number of tasks
      $totalRows = $this->totalRows;
      # find if there is previous page or not
      $previous = $page == 1 ? false : true;
      # find if there is next page or not
      $next = $page * $this->tasksPerPage >= $this->totalRows ? false : true;

      # return data
      return compact('data', 'previous', 'next');
    } catch (PDOException $e) {
      # if some error occurred during the database connection
      return false;
    }
  }

  # get only one task by id from database function
  function getTaskById($id)
  {
    try {
      # sql query -> get task with unique id
      $sql = "SELECT * FROM $this->table WHERE `id`=$id";

      # create prepare statements
      $stmt = $this->conn->prepare($sql);
      # execute prepare statements
      $stmt->execute();
      # return tasks in form of Associative array
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      # get one task
      $data = $stmt->fetch();

      # return data
      return compact('data');
    } catch (PDOException $e) {
      # if some error occurred during the database connection
      return false;
    }
  }

  # update row in database function
  function update_data($id, $data)
  {
    try {
      $text = $data['text'];
      $done = $data['done'];

      # sql query -> update task's text with $id to $text
      $sql = "UPDATE `$this->table` SET text='$text', done=$done, modified='1' WHERE `id`=$id";

      # return true if successful or false otherwise
      return $this->conn->query($sql);
    } catch (PDOException $e) {
      # if some error occurred during the database connection
      return false;
    }
  }

  # find count of rows function
  function findTotalRows()
  {
    try {
      # sql query -> count of all rows
      $sql = "SELECT COUNT(*) FROM $this->table";

      # store the result in class variable
      $this->totalRows = intval($this->conn->query($sql)->fetchColumn());
      # return true if successful
      return true;
    } catch (PDOException $e) {
      # if some error occurred during the database connection
      return false;
    }
  }
}
