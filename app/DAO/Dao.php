<?php
require_once __DIR__ . '/loadEnv.php';

loadEnv(__DIR__ . '/.env');

mysqli_report(MYSQLI_REPORT_STRICT);

class Dao {
  protected $mysqli;
  /*
    * Constructor. Instantiates a new MySQLi object.
    * Throws an exception if there is an issue connecting
    * to the database.
    */
  function __construct() {
    try{
      $this->mysqli = new mysqli(
        $_ENV['DB_HOST'], 
        $_ENV['DB_USERNAME'], 
        $_ENV['DB_PASSWORD'], 
        $_ENV['DB_DATABASE']
      );
      if (!$this->mysqli) {
        die('cannot access db');
      }
    } catch(mysqli_sql_exception $e){
      throw $e;
    }
  }

  protected function getConnection() {
    return $this->mysqli;
  }

  public function checkConnection() {
    if ($this->mysqli->connect_error) {
      die("Connection failed: " . $this->mysqli->connect_error);
    }
  }

  protected function closeConnection() {
    $this->mysqli->close();
  }
}
