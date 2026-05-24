<?php

namespace App\Models;

use PDO;

class Doctor {

    public int $id;
    public int $user_id;
    public int $major_id;
    public string $phone;
    public string $email;
    public string $image;
    public string $description;


    public function __construct(
        $id,
        $user_id,
        $major_id,
        $phone,
        $email,
        $image,
        $description
    ){

        $this->id = $id;
        $this->user_id = $user_id;
        $this->major_id = $major_id;

        $this->phone = $phone;
        $this->email = $email;
        $this->image = $image;
        $this->description = $description;
    }


    // ==== GETTERS ====

    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function getMajorId(){
        return $this->major_id;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getEmail(){
        return $this->email;
    }
    public function getImage(){
        return $this->image;
    }

    public function getDescription(){
        return $this->description;
    }


    // ==== CREATE ====

    public function create(
        PDO $pdo,
        string $name,
        string $user_id,
        int $major_id,
        string $phone,
        string $email,
        string $image,
        string $description
    )
    {
        // insert user

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userSql = "INSERT INTO users(name,email,password,role)
                    VALUES(?,?,?,?)";

        $userStmt = $pdo->prepare($userSql);

        $userSuccess = $userStmt->execute([
            $name,
            $email,
            $hashedPassword,
            'doctor'
        ]);


        if($userSuccess){

            $user_id = $pdo->lastInsertId();

            // insert doctor

            $doctorSql = "INSERT INTO doctors
            (user_id,major_id,phone,email,image,description)
            VALUES(?,?,?,?,?,?)";

            $doctorStmt = $pdo->prepare($doctorSql);

            $doctorSuccess = $doctorStmt->execute([
                $user_id,
                $major_id,
                $phone,
                $email,
                $image,
                $description
            ]);


            if($doctorSuccess){

                $doctor_id = $pdo->lastInsertId();

                return new self(
                    $doctor_id,
                    $name,
                    $user_id,
                    $major_id,
                    $phone,
                    $email,
                    $image,
                    $description
                );
            }
        }
    }



    // ==== GET ALL ====

    public function getAll(PDO $pdo){

        $sql = "
        SELECT doctors.*, users.name, majors.title AS major_title

        FROM doctors

        JOIN users
        ON doctors.user_id = users.id

        JOIN majors
        ON doctors.major_id = majors.id
        ";

        $stmt = $pdo->query($sql);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $doctors = [];

        foreach($rows as $doctor){

            $doctors[] = new self(

                $doctor['id'],
                $doctor['user_id'],
                $doctor['major_id'],
                $doctor['phone'],
                $doctor['email'],
                $doctor['image'],
                $doctor['description']
            );
        }

        return $doctors;
    }



    // ==== UPDATE ====

    public function update(
        PDO $pdo,
        int $id,
        int $major_id,
        int $user_id,
        string $email,
        string $phone,
        string $image,
        string $description
    ){

        $doctor = self::findById($pdo, $id);

        // update users

        $userSql = "
        UPDATE users
        SET name = ?, email = ?
        WHERE id = ?
        ";

        $userStmt = $pdo->prepare($userSql);

        $userStmt->execute([
            $name,
            $email,
            $doctor->getUserId()
        ]);


        // update doctors

        $doctorSql = "
        UPDATE doctors

        SET
        major_id = ?,
        phone = ?,
        email = ?,
        image = ?,
        description = ?

        WHERE id = ?
        ";

        $doctorStmt = $pdo->prepare($doctorSql);

        return $doctorStmt->execute([
            $id,
            $user_id,
            $major_id,
            $phone,
            $email,
            $image,
            $description
        ]);
    }



    // ==== DELETE ====

    public function delete(PDO $pdo, int $id){

        $doctor = self::findById($pdo, $id);

        // delete doctor

        $doctorSql = "DELETE FROM doctors WHERE id=?";

        $doctorStmt = $pdo->prepare($doctorSql);

        $doctorStmt->execute([$id]);


        // delete user

        $userSql = "DELETE FROM users WHERE id=?";

        $userStmt = $pdo->prepare($userSql);

        return $userStmt->execute([
            $doctor->getUserId()
        ]);
    }

}

?>