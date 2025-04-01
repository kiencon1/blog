<?php
  require_once __DIR__ . '/../layout/header.php';
?>
  <main class='main'>
    <div class='container flex justify-center items-center h-full flex-col'>
      <h2>Explore topics</h2>
      <form class='my-4' action='search.php' method='GET'>
        <div class='mb-3'>
          <label for='exampleInputUser' class='form-label'>Title</label>
          <input placeholder='Search by title' 
            name='title' type='text' class='form-control' 
            id='exampleInputUser'
          >
          <div id='emailHelp' class='form-text'></div>
        </div>
        <div class='mb-3'>
          <label for='categoryIpt' class='form-label'>Category</label>
          <select class='form-select' name='categoryID' id='categoryIpt'>
            <?php
              echo "<option value=''>Filter by category</option>";
              if (isset($categories)) {
                for($i = 0; $i < count($categories); $i++) {
                  $id = $categories[$i]['ID'];
                  $name = $categories[$i]['Name'];
                  echo "<option value=$id>$name</option>";
                }
              }
            ?>
          </select>
        </div>
        <div class='mb-3'>
          <label for='authorIpt' class='form-label'>Author</label>
          <select class='form-select' name='authorID' id='authorIpt'>
            <?php
              echo "<option selected value=''>Filter by author</option>";
              if (isset($authors)) {
                foreach ($authors as $author) {
                  $id = $author['ID'];
                  $name = $author['Name'];
                  echo "<option value='$id'>$name</option>";
                }
              }
            ?>
          </select>
        </div>
        <button type='submit' class='btn btn-primary'>Submit</button>
      </form>
      <div class="w-full">
        <?php
          if (isset($searchingPosts)) {            
            foreach($searchingPosts as $post) {
              $slug = $post['Slug'];
              $categoryName = $post['CategoryName'];
              $updatedAt = $post['UpdatedAt'];
              $title = $post['Title'];
              $author = $post['UserName'];
              echo "<a href='/blog/post/". $slug .".php' class='card w-full text-decoration-none p-30px mb-30px'>";
              echo "<p>In $categoryName by $author </p>";
              echo "<h3>Title: $title</h3>";
              echo "<p>$updatedAt</p></a>";
            }
          }
        ?>
      </div>
    </div>
  </main>
<?php
  require_once __DIR__ . '/../layout/footer.php';
?>
