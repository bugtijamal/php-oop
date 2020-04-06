<?php
session_start();
include_once "Connection.php";

class User extends Connection{
 //register new users
    public function insert($table, $data){
        if(!empty($data) && is_array($data)){
            $columns = implode(',', array_keys($data));
            $values = ":".implode(',:', array_keys($data));

            $sql="INSERT INTO " .$table."(".$columns.") VALUES (".$values.")";
            $query = $this->db->prepare($sql);
            
            foreach($data as $key=>$value){
                $query->bindValue(':'.$key, $value);
            }
            $insert = $query->execute();
            return $insert;
        }
        else{
            return false;
        }
    }
   // get all users 
    public function select($table){
        $query = $this->db->prepare("SELECT * FROM $table ORDER BY id DESC");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }
    public function profile($table, $id){
        $query = $this->db->prepare("SELECT * FROM $table WHERE id = :id LIMIT 1");
        $query->execute(array(":id"=>$id));
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    // Login method 
   public function login($table, $email, $password){
       $error ="";
       $query = $this->db->prepare("SELECT * FROM $table WHERE email= :email");
       $query->execute(array(":email"=>$email));
       $row = $query->fetch(PDO::FETCH_ASSOC);
       if($row && is_array($row)){
           if(password_verify($password, $row['password'])){
               $_SESSION['user_id'] = $row['id'];
               $_SESSION['login'] =true;
               return $row;
           }
           else{
           $_SESSION['messages'] ="Wrong password try again !";
            header("Location:login.php");
            
            
           }
       }
       else{
        $_SESSION['messages'] ="This email address deosn't exist!";
        header("Location:login.php");
       
          
       }
   }
  
 
}