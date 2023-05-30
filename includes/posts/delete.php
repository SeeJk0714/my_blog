<?php
    $database = connectToDB();

    $id = $_POST["id"];

    if(empty($id)){
        $error = "ERROR!";
    }

    if(isset($error)){
        $_SESSION['error'] = $error;
        header("Location: /manage-posts");
        exit;
    }

    $sql = "DELETE FROM posts WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'id' => $id
    ]);

    $_SESSION["success"] = "post has been deleted.";

    header("Location: /manage-posts");
    exit;
