<?php
class Connection {

    private $host = 'localhost';
    private $username ='root';
    private $password ='mysql';
    private $dbname ='crud';

    public function __construct(){
        if(!isset($this->db)){
            try{
                $db = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db = $db;   
            }
            catch (PDOException $e){
             die("Failed to connect with mysql ". $e->getMessage());
            }
        }
    }
}
