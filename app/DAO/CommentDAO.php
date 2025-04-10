<?php
class CommentDAO extends Dao {
  function __construct() {
    parent::__construct();
  }

  function comment($userID, $postID, $content) {
    $sql = 'INSERT INTO Comment (UserID, PostID, Content) VALUES (?, ?, ?)';
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param('iis', $userID, $postID, $content);
    $stmt->execute();
  }

  function getByPostID($postID) {
    $sql = 'SELECT Comment.ID, Content, UserID, Comment.UpdatedAt, User.Name FROM Comment 
      JOIN User ON User.ID = Comment.UserID WHERE PostID = ? ORDER BY Comment.ID DESC';
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param('i', $postID);
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

  function getBySlug($slug) {
    $sql = 'SELECT Comment.ID, Comment.Content, Comment.UserID, Comment.UpdatedAt, User.Name 
      FROM Comment JOIN User 
      ON User.ID = Comment.UserID JOIN Post ON Post.ID = Comment.PostID 
      WHERE Post.Slug = ? ORDER BY Comment.ID DESC';
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param('s', $slug);
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
