<?php

class Comment 
{

    public static function getCommentsByPostID($post_id)
    {
        $db = new DB();
        $sql = "SELECT
            comments.*,
            users.name
            FROM comments
            JOIN users
            ON comments.user_id = users.id
            WHERE post_id = :post_id ORDER BY id DESC";

            $comments = $db->fetchAll(
            $sql,
            [
                "post_id" => $post_id
            ]
        );
        return $comments;
    }

    public static function add()
    {
        if ( !Auth::isUserLoggedIn() ) {
            header("Location: /");
            exit;
        }
    
    
        $db = new DB();
    
        // get all the POST data
        $comments = $_POST['comments'];
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];
    
        // do error checking
        if ( empty( $comments ) || empty( $post_id ) || empty( $user_id ) ) {
            $error = "Please fill out the comment";
        }
        
        if( isset ($error)){
            $_SESSION['error'] = $error;
            header("Location: /post?id=$post_id" ); 
            exit;
        }
    
        // insert the comment into database
        $sql = "INSERT INTO comments (`comments`, `post_id`, `user_id`)
        VALUES(:comments, :post_id, :user_id)";
        $db->insert(
            $sql,
            [
                'comments' => $comments,
                'post_id' => $post_id,
                'user_id' => $user_id
            ]);

        header("Location: /post?id=$post_id" );
        exit;
    }
}