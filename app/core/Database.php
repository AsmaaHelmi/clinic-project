<?php
namespace app\core\Database ;
use PDO;
use PDOException ;

class Database{
private string $host="localhost";
private string $dbName="clinic_project";
private string $username="root";
private string $password="";
public PDO $conn;
private function connect(){
    try{
    $pdo=new PDO("host={$this->host};dbname={$this->dbName};",$this->username,$this->password);}
    catch(PDOException $e){
           die("Connection Failed: " . $e->getMessage());
    }
}
public function selectAll($sql,$param=[]){
    $statm=$this->conn->prepare($sql);
    $statm=execute($param);
    $data=$statm->fetchAll();
    return $data;

}
public function execute($sql,$param=[]){
    $statm=$this->conn->prepare($sql);
    $statm=execute($param);
}


}



?>