<?php
class CategoryDAO extends Dao {
  function __construct() {
    parent::__construct();
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
