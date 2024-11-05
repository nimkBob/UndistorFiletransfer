<?php
class Sql{
  private $servername="localhost";
  private $username="your_username";
  private $password="your_password";
  private $dbname="your_database";

  public function validateSqlColumn($sum,$column,$table){ 
    $conn=new mysqli($this->servername,$this->username,$this->password,$this->dbname);
    if($conn->connect_error){
       return false;
    }
    $sq="SELECT ".$column." FORM ".$table;
    $result=$conn->query($sq);
    if($result->num_rows>0){
       while($row=$result->fetch_assoc()){
         if($sum==$row['name']){
         $conn->close();
         return  false;
         }
       }
       $conn->close();
       return true;
    }
    else{
        $conn->close();
        return true;

    }
  }

}
?>