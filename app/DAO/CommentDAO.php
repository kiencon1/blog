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
    //todo
    return [];
  }

  function getBySlug($slug) {
    //todo
    return [];
  }
}
