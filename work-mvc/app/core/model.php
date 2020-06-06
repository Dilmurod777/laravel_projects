<?php

class Model
{
  public $server = "localhost";
  public $database = "work-mvc";
  public $table = "tasks";
  public $username = "root";
  public $password = "";
  public $conn = null;
  public $totalRows = 0;

  function __construct()
  {
    $this->db_connect();
  }

  function db_connect()
  {
    try {
      $conn = new PDO("mysql:host=$this->server;dbname=$this->database", $this->username, $this->password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->conn = $conn;
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }
}
