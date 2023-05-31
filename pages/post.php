<?php
if ( isset( $_GET['id'] ) ) {
  // load database
  $database = connectToDB();

  // load the post data based on the id
  $sql = "SELECT * FROM posts WHERE id = :id AND status = 'publish'";
  $query = $database->prepare( $sql );
  $query->execute([
    'id' => $_GET['id']
  ]);

  // fetch
  $posts = $query->fetch();

  if ( !$posts ) {
    // if post don't exists, then we redirect back to home
    header("Location: /");
    exit;
}

}else{
  // if $_GET['id'] is not available, then redirect the user back to home
  header("Location: /");
  exit;
}
  require "parts/header.php";
?>
    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center"><?= $posts['title']; ?></h1>
      <p>
        <?php 
          echo nl2br($posts['content']);
          // // turn this content to an array
            // $paragraphs_array = preg_split( '/\n\s*\n/', $post["content"] );
            
            // // once we have the array, we'll use foreach to print out each line using <p>
            // foreach( $paragraphs_array as $paragraph ) {
            //     echo "<p>";
            //     // split by breakline
            //     $lines_array = preg_split( '/\n/',$paragraph );
            //     foreach( $lines_array as $line ) {
            //         echo "$line<br />";
            //     }
            //     echo "</p>";
            // }
        ?>
      </p>
      <div class="text-center mt-3">
        <a href="/" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>
<?php
  require "parts/footer.php";

