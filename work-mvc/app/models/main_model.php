<?php

class Main_Model extends Model
{
  public $tasksPerPage = 3; # 3 tasks per page

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

  # insert data function
  function insert_data($data)
  {
    try {
      # XSS security based receiving username, email and text from inputs
      $username = $data['username'];
      $email = $data['email'];
      $text = $data['text'];

      # sql query -> insert values to the database table
      $sql = "INSERT INTO `$this->table` (`username`, `email`, `text`) VALUES ('$username', '$email', '$text')";

      # execute statement
      $this->conn->exec($sql);
      # increase the local number of rows
      $this->totalRows++;
      # return true if successful
      return true;
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
