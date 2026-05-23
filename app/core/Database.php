<<<<<<< HEAD
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



=======
<?php
// namespace app\Database;
// require_once __DIR__ . "../../vendor/autoload.php";
// use PDO;
// //use PDOException;

// // $host = "localhost";
// // $dbName = "clinic_root";
// // $user = "root";
// // $pass = "";
// // try{
// // $pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
// // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
// // catch(PDOException $e){
// //     die("database connection failed".$e->getMessage());
// // }

// class Database {
//     public PDO $conn;

//     public function __construct() {
//         $this->conn = new PDO(
//             "mysql:host=localhost;dbname=clinic_project",
//             "root",
//             ""
//         );

      
//         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     }
// }




>>>>>>> develop
?>