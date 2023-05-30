<?php
 if ( isset( $_GET['id'] ) ) {
  // load database
  $database = connectToDB();

  // load the post data based on the id
  $sql = "SELECT * FROM posts WHERE id = :id";
  $query = $database->prepare( $sql );
  $query->execute([
    'id' => $_GET['id']
  ]);

  // fetch
  $posts = $query->fetch();

}else{
  header("Location: /");
  exit;
}
  require "parts/header.php";
?>
    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center"><?= $posts['title']; ?></h1>
      <p>
        <?= $posts['content']; ?>
      </p>
      <div class="text-center mt-3">
        <a href="/" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>
<?php
  require "parts/footer.php";

