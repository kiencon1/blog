<?php
require_once __DIR__ . '/../DAO/PostDAO.php';

class Post {
  public $ID;
  public $UserID;
  public $Title;
  public $Categories;
  public $Slug;
  public $CreatedAt;
  public $UpdatedAt;
  public $Content;

  private $postDAO;

  public function __construct($userID, $title, $categories, $slug, $content, $postDAO) {
    $this->UserID = $userID;
    $this->Title = $title;
    $this->Categories = $categories;
    $this->Slug = $slug;
    $this->Content = $content;

    //dependency injection by constructor
    $this->postDAO = $postDAO;
  }

  public function create() {
    $this->postDAO->checkConnection();
    if ($this->postDAO->getPostBySlug($this->Slug) != null) {
      throw new Exception('Title is already exist');
    }

    $this->postDAO->create($this->UserID, $this->Title, $this->Categories, $this->Slug, $this->Content);
  }
}
