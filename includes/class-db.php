<?php
class DB 
{
    private $host = 'devkinsta_db';
    private $dbname = 'Exercise_My_Blog';
    private $dbuser = 'root';
    private $dbpassword = 'GObT0SaYlthXkrat';
    private $db;

    function __construct()
    {
        $this->db = new PDO(
            "mysql:host=$this->host;dbname=$this->dbname", 
            $this->dbuser, // username
            $this->dbpassword // password 
        );
    }
    function fetch($sql, $data = [])
    {
        $query = $this->db->prepare( $sql );
        $query->execute($data);
        return $query->fetch();
    }
    function fetchAll($sql, $data = [])
    {
        $query = $this->db->prepare( $sql );
        $query->execute($data);
        return $query->fetchAll();
    }
    function insert( $sql, $data = [] )
    {
        $query = $this->db->prepare( $sql );
        $query->execute( $data );
    }

    function update( $sql, $data = [] )
    {
        $query = $this->db->prepare( $sql );
        $query->execute( $data );
    }

    function delete( $sql, $data = [] )
    {
        $query = $this->db->prepare( $sql );
        $query->execute( $data );
    }
}