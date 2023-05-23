<?php
function connectToDB(){
    $host = 'devkinsta_db';
    $dbname = 'Exercise_My_Blog';
    $dbuser = 'root';
    $dbpassword = 'GObT0SaYlthXkrat';
    //connext to database (PDO - PHP database Object)
    $database = new PDO (
        "mysql:host=$host;dbname=$dbname",
        $dbuser,//username
        $dbpassword//password
    );

    return $database;
}