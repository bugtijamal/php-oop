<?php

include_once "Connection.php";

class User extends Connection{

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
   
  public function select($table){
      $query = $this->db->prepare("SELECT * FROM $table ORDER BY id DESC");
      $query->execute();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
          $data[] = $row;
      }
      return $data;
  }
}