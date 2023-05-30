<?php
    $database = connectToDB();

    $title = $_POST["title"];
    $content = $_POST["content"];
    
    if(empty($title) || empty($content)){
        $error = "All fields are required";
    }

    if( isset ($error)){
        $_SESSION['error'] = $error;
        header("Location: /manage-posts-add");    
    } else {
        $sql = "INSERT INTO posts (`title`, `content`, `user_id`)
        VALUES(:title, :content, :user_id)";
        $query = $database->prepare( $sql );
        $query->execute([
            'title' => $title,
            'content' => $content,
            'user_id' => $_SESSION['user']['id']
        ]);

        $_SESSION["success"] = "New post has been created.";
        header("Location: /manage-posts");
        exit;
    }