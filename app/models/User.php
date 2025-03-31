<?php
class User {
  public $ID;
  public $Name;
  public $Password;
  public $CreatedAt;
  public $UpdatedAt;
  public function __construct($username, $password) {
    $this->Name = $username;
    $this->Password = $password;
  }
}
