<?php
session_start();
// require "includes/functions.php";
require "includes/class-db.php";
require "includes/class-auth.php";
require "includes/class-user.php";
require "includes/class-post.php";
require "includes/class-comment.php";

$path = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
$path = trim($path,'/');
switch($path){
    // auth
    case 'auth/login':
        Auth::login();
        break;
    case 'auth/signup':
        Auth::signup();
        break;
    // users
    case 'users/add':
        User::add();
        break;
    case 'users/edit':
        User::edit();
        break;
    case 'users/delete':
        User::delete();
        break;
    case 'users/changepwd':
        User::changepwd();
        break;
    //posts
    case 'posts/add':
        Post::add();
        break;
    case 'posts/edit':
        Post::edit();
        break;
    case 'posts/delete':
        Post::delete();
        break;
    //comments
    case 'comments/add':
        Comment::add();
    //pages
    case 'dashboard':
        require 'pages/dashboard.php';
        break;
    case 'login':
        require 'pages/login.php';
        break;
    case 'signup':
        require 'pages/signup.php';
        break;
    case 'logout':
        Auth::logout();
        break;
    case 'post':
        require 'pages/post.php';
        break;
    //post
    case 'manage-posts':
        require 'pages/posts/manage-posts.php';
        break;
    case 'manage-posts-add':
        require 'pages/posts/manage-posts-add.php';
        break;
    case 'manage-posts-edit':
        require 'pages/posts/manage-posts-edit.php';
        break;
    //user
    case 'manage-users':
        require 'pages/users/manage-users.php';
        break;
    case 'manage-users-add':
        require 'pages/users/manage-users-add.php';
        break;
    case 'manage-users-edit':
        require 'pages/users/manage-users-edit.php';
        break;
    case 'manage-users-changepwd':
        require 'pages/users/manage-users-changepwd.php';
        break;
    default:
        require 'pages/home.php';
        break;
}