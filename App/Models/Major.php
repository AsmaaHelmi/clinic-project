<?php
namespace App\Models;
use PDO;

class Major {
    
    public int $id;
    public string $title;
    public string $description;

    public function __construct($id,$title, $description){
      
        $this->id=$id;
        $this->title=$title;
        $this->description=$description;

    }
    public function getId(){
        return $this->id;
    }
     public function getTitle(){
        return $this->title;
    } 
     public function getDescription(){
        return $this->description;
    } 
    //-----------
    

     

    public  static function create(PDO $pdo,string $title,string $description){

        $sql="INSERT INTO `majors` (title,description) VALUES(?,?)";
        $statm=$pdo->prepare($sql);
        $success=$statm->execute([$title,$description]);
     

        if($success){
            $id=$pdo->lastInsertId();
            return  new self($id, $title,$description);

        }
      

    }
 
    public static function getAll(PDO $pdo){
        $sql=$pdo->query("SELECT * from majors");
        $rows=$sql->fetchAll(PDO::FETCH_ASSOC);
        $majors=[];
        foreach($rows as $major){
            $majors[]=new self($major['id'],$major['title'],$major['description']);
        }
        return $majors;
    }
    public static function findById(PDO $pdo,int $id){
        $sql="SELECT * from `majors` WHERE id=?";
        $statm=$pdo->prepare($sql);
       $statm->execute([$id]);
       $row=$statm->fetch(PDO::FETCH_ASSOC);
       if($statm){
        return new self($row['id'],$row['title'],$row['description']);

       }

    }
    public static function update(PDO $pdo,int $id,string $title,string $description){
        $sql="UPDATE `majors` SET title=?,description=? Where id=?";
        $statm=$pdo->prepare($sql);
       return $statm->execute([$title,$description,$id]);
        
       
     

    }

    public static function delete(PDO $pdo,int $id){
        $sql="DELETE FROM majors WHERE id=?";
        $statm=$pdo->prepare($sql);
        return $statm->execute([$id]);
         
      
    }
    


}




















?>