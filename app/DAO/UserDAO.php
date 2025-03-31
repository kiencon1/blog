<?php

require_once __DIR__ .'/Dao.php';
require_once __DIR__ .'/../models/User.php';

class UserDAO extends Dao {
  public function __construct() {
    parent::__construct();
  }

  public function create(User $user) {
    $sql = 'INSERT INTO user (Name, Password) VALUES (?, ?)';
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param('ss', $user->Name, $user->Password);
    if ($stmt->execute()) {
      var_dump('Record created successfully.');
    } else {
      var_dump('Error '. $stmt->error);
    }
  }

  public function validateUser($name, $password) {
    $sql = 'Select id, name, password from user where name = (?)';
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      return ['isValid' => password_verify($password, $row['password']), 'userID' => $row['id']];
    }

    return ['isValid' => false];;
  }
}
