<?php

require_once __DIR__ .'/Dao.php';

class PostDAO extends Dao {
  public function __construct() {
    parent::__construct();
  }

  function create($userID, $title, $categoryIDs, $slug, $content) {
    try {
      $this->mysqli->begin_transaction();
      $sql = 'INSERT INTO post (Title, Slug, UserID, Content) VALUES (?, ?, ?, ?)';
      $stmt = $this->mysqli->prepare($sql);
      $stmt->bind_param('ssis', $title, $slug, $userID, $content);
      $stmt->execute();

      $post = $this->getPostBySlug($slug);

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

  function getByDefault() {
    $sql = 'Select * from post join categorypost on post.ID = categorypost.postID order by ID desc';
    $stmt = $this->mysqli->prepare($sql);
    $stmt->execute();

    $data = [];
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    }

    $post = $this->reviseByCategoryName($data);

    return $this->reviseByUserName($post);
  }

  function getByUserID($userID) {
    $sql = 'Select * from post join categorypost on post.ID = categorypost.postID where post.UserID = ? order by ID desc';
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param('i', $userID);
    $stmt->execute();

    $data = [];
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    }

    return $this->reviseByCategoryName($data);
  }

  private function reviseByCategoryName($post) {
    $categoryIDs = array_map(function($row){
      return $row['CategoryID'];
    }, $post);

    $uniqueCategoryIDs = array_unique($categoryIDs);

    //it is okay in this context
    $sql = "Select ID, Name from category where ID IN (". implode(',', $uniqueCategoryIDs) .")";
    $stmt = $this->mysqli->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $categoryMap = [];
    while($row = $result->fetch_assoc()) {
      $categoryMap[$row['ID']] = $row['Name'];
    }

    for($i = 0; $i < count($post); $i++) {
      $categoryID = $post[$i]['CategoryID'];
      $post[$i]['CategoryName'] = $categoryMap[$categoryID];
    }

    return $post;
  }

  private function reviseByUserName($post) {
    $userIDs = array_map(function($row){
      return $row['UserID'];
    }, $post);

    $uniqueUserIDs = array_unique($userIDs);

    //it is okay in this context
    $sql = "Select ID, Name from user where ID IN (". implode(',', $uniqueUserIDs) .")";
    $stmt = $this->mysqli->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $userMap = [];
    while($row = $result->fetch_assoc()) {
      $userMap[$row['ID']] = $row['Name'];
    }

    for($i = 0; $i < count($post); $i++) {
      $userID = $post[$i]['UserID'];
      $post[$i]['UserName'] = $userMap[$userID];
    }

    return $post;
  }
}
