<?php

$database = connectToDB();

$title = $_POST["title"];
$content = $_POST["content"];
$status = $_POST["status"];
$id =$_POST["id"];

if(empty($title) || empty($content) || empty($status) || empty($id)){
    $error = "Please enter fields";
}

if(isset($error)){
    $_SESSION['error'] = $error;
    header("Location: /manage-posts-edit?id=$id");
    exit;
}

$sql = "UPDATE posts set title = :title, content = :content, status = :status WHERE id = :id";
$query = $database->prepare($sql);
$query->execute([
    'title' => $title,
    'content' => $content,
    'status' => $status,
    'id' => $id
]);

header("Location: /manage-posts");
exit;