<?php

require_once __DIR__ .'/Dao.php';

class PostDAO extends Dao {
  public function __construct() {
    parent::__construct();
  }

  function create($userID, $title, $categoryIDs, $slug) {
    var_dump($userID, $title, $categoryIDs, $slug);
    try {
      $this->mysqli->begin_transaction();
      $sql = 'INSERT INTO post (Title, Slug, UserID) VALUES (?, ?, ?)';
      $stmt = $this->mysqli->prepare($sql);
      $stmt->bind_param('ssi', $title, $slug, $userID);
      $stmt->execute();

      $post = $this->getPostBySlug($slug);

      var_dump($post);

      if (!$post) {
        throw new Exception('Post not found');
      }

      $postID = $post['ID'];
      
      for($i = 0; $i < count($categoryIDs); $i++) {
        $sql = 'INSERT INTO categorypost (CategoryID, PostID) VALUES (?, ?)';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('ii', $categoryIDs[$i], $postID);
        $stmt->execute();
      }
      
      $this->mysqli->commit();
    } catch (Exception $e) {
      $this->mysqli->rollback();
      echo $e->getMessage();
    }
  }

  function getPostBySlug($slug) {
    $sql = 'Select * from post where slug = (?)';
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
      return null;
    }

    return $result->fetch_assoc();
  }

  function getCategories() {
    $sql = 'Select ID, Name from category';
    $stmt = $this->mysqli->prepare($sql);
    $stmt->execute();

    $data = [];
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    }

    return $data;
  }
}
