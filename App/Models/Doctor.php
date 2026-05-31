<?php

namespace App\Models;
use App\traits\ManageFiles;


use PDO;

class Doctor 
{

    public int $id;
    public int $user_id;
   
   

    public string $major_title;
    public string $phone;
  

    public string $description;
    private ?string $image=null;



    public function __construct(
        $id,
        $user_id,
    
       
   
         $major_title,
        $phone,


        $description,
        $image=null,
          $name = null,
    $email = null,
    $password=null,

    ) {

        $this->id = $id;
        $this->user_id = $user_id;
      

        $this->major_title = $major_title;
        $this->phone = $phone;
      

        $this->description = $description;

       $this->image = $image;
        $this->name = $name;
    $this->email = $email;
    $this->password = $password;

       
    }


    // ==== GETTERS ====

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }


    public function getMajorId()
    {
        return $this->major_title;
    }

    public function getPhone()
    {
        return $this->phone;
    }
    
public function getName()
{
    return $this->name;
}

public function getEmail()
{
    return $this->email;
}

    public function getImage()
    {
        return $this->image;
    }
       public function getPassword()
    {
        return $this->password;
    }

    public function getDescription()
    {
        return $this->description;
    }


    // ==== CREATE ====

    public static function create(
        PDO $pdo,
     
        string $user_id,
        string $major_title,
        string $phone,
       string $description,
       ?array $image = null
       
    ) { $imageName = null;

        if($image && is_array($image)){
            $imageName = ManageFiles::uploadImage($image,"doctors");
        }

            // insert doctor

            $doctorSql = "INSERT INTO doctors
            (user_id,major_id,phone,description,image)
            VALUES(?,?,?,?,?)";

            $doctorStmt = $pdo->prepare($doctorSql);

            $doctorSuccess = $doctorStmt->execute([
               
                $user_id,
                $major_title,
                $phone,
                $description,
                $imageName

            ]);


            if ($doctorSuccess) {

                $id = $pdo->lastInsertId();

                return new self(
                    $id, 
                    $user_id,
                   
                    $major_title,
                    $phone,
                    $description,
                    $imageName
   
   
   
  
   
   

                );
            }
        }
    



    // ==== GET ALL ====

    public static function getAll(PDO $pdo)
    {

        $sql = "
       SELECT 
    doctors.id,
    doctors.user_id,
    doctors.major_id,
    doctors.phone,
    doctors.description,
    doctors.image,
    users.name,
    users.email,
    users.password,
    majors.title AS major_title
FROM doctors
JOIN users ON doctors.user_id = users.id
JOIN majors ON doctors.major_id = majors.id
        ";

        $stmt = $pdo->query($sql);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $doctors = [];

        foreach ($rows as $doctor) {

            $doctors[] = new self(

                $doctor['id'],
    $doctor['user_id'],
    $doctor['major_title'],
    $doctor['phone'],
    $doctor['description'],
    $doctor['image'],
    $doctor['name'],
    $doctor['email'],
    $doctor['password'],
    $doctor['major_title']

            );
        }

        return $doctors;
    }



    // ==== FIND BY ID =====

    public static function findById(PDO $pdo, int $id)
    {

        $sql = "
        SELECT doctors.*, users.name,users.email, majors.title AS major_title

        FROM doctors

        JOIN users
         ON doctors.user_id = users.id

        JOIN majors
        ON doctors.major_id = majors.id

        WHERE doctors.id = ?
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([$id]);

        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($doctor) {

            return new self(

                $doctor['id'],
                $doctor['user_id'],

                $doctor['name'],
                $doctor['email'],


                
                $doctor['major_title'],
                $doctor['phone'],
                $doctor['image'],
                $doctor['description'],
                 //$doctor['password'],
            );
        }
    }



    // ==== UPDATE =====

    public static function update(
        PDO $pdo,
        int $id,
      
      
        int $major_id,
        string $phone,
       
        string $description,
         string $image=null,
    ) {

        $doctor = self::findById($pdo, $id);

     


        // update doctors

        $doctorSql = "
        UPDATE doctors

        SET
       
        major_id = ?,
        phone = ?,
        image = ?,
        description = ?
        WHERE id = ?
        ";

        $doctorStmt = $pdo->prepare($doctorSql);

        return $doctorStmt->execute([
           

            $major_id,
            
            $phone,
            
           
          
            $image,
            $description,
            $id
        ]);
    }


    // ==== DELETE ====

    public static function delete(PDO $pdo, int $id)
    {

        $doctor = self::findById($pdo, $id);
         if (!$doctor) {
        return false;
    }
    $userId = $doctor->getUserId();


           $doctorSql = "DELETE FROM doctors WHERE id = ?";
    $doctorStmt = $pdo->prepare($doctorSql);
    $doctorStmt->execute([$id]);

    // 3. delete user
    $userSql = "DELETE FROM users WHERE id = ?";
    $userStmt = $pdo->prepare($userSql);

    return $userStmt->execute([$userId]);
}
         
      
    }
    