<?php

class Post
{

    public static function getPostByID()
    {
        if ( isset( $_GET['id'] ) ) {

            $db = new DB();
          
            $sql = "SELECT * FROM posts WHERE id = :id AND status = 'publish'";
            $posts = $db->fetch(
                $sql,
                [
                    'id' => $_GET['id']
                ]
            );
          
            if ( !$posts ) {
              // if post don't exists, then we redirect back to home
              header("Location: /");
              exit;
          }
          return $posts;
          
          }else{
            // if $_GET['id'] is not available, then redirect the user back to home
            header("Location: /");
            exit;
          }
    }

    public static function getPostEditByID()
    {
        if ( isset( $_GET['id'] ) ) {
            // load database
            $db = new DB();
        
            // load the post data based on the id
            $sql = "SELECT
            posts.*,
            users.name
            FROM posts 
            JOIN users
            ON posts.modified_by = users.id
            WHERE posts.id = :id";
        
            return $post = $db->fetch($sql,['id' => $_GET['id']]);
        
          }else{
            header("Location: /manage-posts");
            exit;
        }
    }

    public static function getPostsByUserRole()
    {
        $db = new DB();
  
        if ( Auth::isAdmin()){
          // $sql = "SELECT * FROM posts";
          $sql = "SELECT 
          posts.*, 
          users.name AS user_name,
          users.email AS user_email 
          FROM posts 
          JOIN users 
          ON posts.user_id = users.id";

        $posts = $db->fetchAll($sql);

        }else{
          // $sql = "SELECT * FROM posts where user_id = :user_id";
          $sql = "SELECT 
              posts.id, 
              posts.title, 
              posts.status, 
              users.name AS user_name 
              FROM posts 
              JOIN users 
              ON posts.user_id = users.id 
              where posts.user_id = :user_id";
       
          $posts = $db->fetchAll(
            $sql,
            ['user_id' => $_SESSION["user"]["id"]]
        );
        }
        
        return $posts;
    }

    public static function getPublishPosts()
    {
        $db = new DB();

        $sql = "SELECT * FROM posts where status = 'publish' ORDER BY id DESC";
        $posts = $db->fetchAll($sql);
        return $posts;
    }

    public static function add()
    {
        if ( !Auth::isUserLoggedIn() ) {
            header("Location: /");
            exit;
        }
    
        $db = new DB();
    
        $title = $_POST["title"];
        $content = $_POST["content"];
        
        if(empty($title) || empty($content)){
            $error = "All fields are required";
        }
    
        if( isset ($error)){
            $_SESSION['error'] = $error;
            header("Location: /manage-posts-add");    
            exit;
        }
        $sql = "INSERT INTO posts (`title`, `content`, `user_id`)
        VALUES(:title, :content, :user_id)";
        $db->insert(
            $sql,
            [
               'title' => $title,
                'content' => $content,
                'user_id' => $_SESSION['user']['id'] 
            ]
        );
    
        $_SESSION["success"] = "New post has been created.";
        header("Location: /manage-posts");
        exit;
        
    }

    public static function edit()
    {
        if ( !isUserLoggedIn() ) {
            header("Location: /");
            exit;
        }
        
        $db = new DB();
        
        $title = $_POST["title"];
        $content = $_POST["content"];
        $status = $_POST["status"];
        $id =$_POST["id"];
        
        if(empty($title) || empty($content) || empty($status) || empty($id)){
            $error = "All fields is requrired";
        }
        
        if(isset($error)){
            $_SESSION['error'] = $error;
            header("Location: /manage-posts-edit?id=$id");
            exit;
        }
        
        $sql = "UPDATE posts set title = :title, content = :content, status = :status WHERE id = :id";
        $db->update(
            $sql,
            [
                'title' => $title,
                'content' => $content,
                'status' => $status,
                'id' => $id
            ]
        );
        
        $_SESSION["success"] = "Post has been edited.";
        
        header("Location: /manage-posts");
        exit;
        
    }

    public static function delete()
    {
        if ( !Auth::isUserLoggedIn() ) {
            header("Location: /");
            exit;
        }
        
        $db = new DB();
        
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
        $db->delete(
            $sql,
            [
                'id' => $id
            ]
        );
        
        $_SESSION["success"] = "post has been deleted.";
        
        header("Location: /manage-posts");
        exit;
        
    }
}
