<?php

namespace App\Models;

use PDO;

class Doctor
{

    public int $id;
    public int $user_id;
    public int $major_id;
    public string $phone;
    public string $image;
    public string $description;


    public function __construct(
        $id,
        $user_id,
        $major_id,
        $phone,
        $image,
        $description
    ) {

        $this->id = $id;
        $this->user_id = $user_id;
        $this->major_id = $major_id;
        $this->phone = $phone;
        $this->image = $image;
        $this->description = $description;
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
        return $this->major_id;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getDescription()
    {
        return $this->description;
    }


    // ==== CREATE ====

    public static function create(
        PDO $pdo,
        string $name,
        string $user_id,
        int $major_id,
        string $phone,
        string $email,
        string $image,
        string $description
    ) {
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


        if ($userSuccess) {

            $user_id = $pdo->lastInsertId();

            // insert doctor

            $doctorSql = "INSERT INTO doctors
            (id,user_id,major_id,phone,image,description)
            VALUES(?,?,?,?,?,?)";

            $doctorStmt = $pdo->prepare($doctorSql);

            $doctorSuccess = $doctorStmt->execute([
                $id,
                $user_id,
                $major_id,
                $phone,
                $image,
                $description
            ]);


            if ($doctorSuccess) {

                $doctor_id = $pdo->lastInsertId();

                return new self(
                    $id,
                    $user_id,
                    $major_id,
                    $phone,
                    $image,
                    $description
                );
            }
        }
    }



    // ==== GET ALL ====

    public static function getAll(PDO $pdo)
    {

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

        foreach ($rows as $doctor) {

            $doctors[] = new self(

                $doctor['id'],
                $doctor['user_id'],
                $doctor['major_id'],
                $doctor['phone'],
                $doctor['image'],
                $doctor['description']
            );
        }

        return $doctors;
    }



    // ==== FIND BY ID =====

    public static function findById(PDO $pdo, int $id)
    {

        $sql = "
        SELECT doctors.*, users.name, majors.title AS major_title

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
                $doctor['major_id'],
                $doctor['phone'],
                $doctor['image'],
                $doctor['description']
            );
        }
    }



    // ==== UPDATE =====

    public static function update(
        PDO $pdo,
        int $id,
        string $name,
        string $email,
        int $major_id,
        string $phone,
        string $image,
        string $description,
    ) {

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
        user_id = ?,
        major_id = ?,
        phone = ?,
        image = ?,
        description = ?,
        WHERE id = ?
        ";

        $doctorStmt = $pdo->prepare($doctorSql);

        return $doctorStmt->execute([
            $id,
            $major_id,
            $phone,
            $email,
            $image,
            $description,
        ]);
    }


    // ==== DELETE ====

    public static function delete(PDO $pdo, int $id)
    {

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
