<?php
namespace App\Models;
use PDO;

class Doctor {

    public function getAll($pdo)
    {
        $query = "SELECT doctors.*, users.name, users.email, majors.title AS major_title
                  FROM doctors
                  JOIN users ON doctors.user_id = users.id
                  JOIN majors ON doctors.major_id = majors.id
                  WHERE users.role = 'doctor'";

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create($pdo, $data)
    {
        // insert into users table
        $userQuery = "INSERT INTO users(name,email,password,role)
                      VALUES(?,?,?,?)";

        $stmt = $pdo->prepare($userQuery);

        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt->execute([
            $data['name'],
            $data['email'],
            $password,
            'doctor'
        ]);

        $userId = $pdo->lastInsertId();


        // insert into doctors table
        $doctorQuery = "INSERT INTO doctors(user_id,major_id,phone,image,description,gender)
                        VALUES(?,?,?,?,?,?)";

        $doctorStmt = $pdo->prepare($doctorQuery);

        return $doctorStmt->execute([
            $userId,
            $data['major_id'],
            $data['phone'],
            $data['image'],
            $data['description'],
            $data['gender']
        ]);
    }


    public function findById($pdo, $id)
    {
        $query = "SELECT doctors.*, users.name, users.email, majors.title AS major_title
                  FROM doctors
                  JOIN users ON doctors.user_id = users.id
                  JOIN majors ON doctors.major_id = majors.id
                  WHERE doctors.id = ?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function update($pdo, $id, $data)
    {
        $doctor = self::findById($pdo, $id);

        // update users table
        $userQuery = "UPDATE users
                      SET name = ?, email = ?
                      WHERE id = ?";

        $stmt = $pdo->prepare($userQuery);

        $stmt->execute([
            $data['name'],
            $data['email'],
            $doctor['user_id']
        ]);


        // update doctors table
        $doctorQuery = "UPDATE doctors
                        SET major_id = ?,
                            phone = ?,
                            image = ?,
                            description = ?,
                            gender = ?
                        WHERE id = ?";

        $doctorStmt = $pdo->prepare($doctorQuery);

        return $doctorStmt->execute([
            $data['major_id'],
            $data['phone'],
            $data['image'],
            $data['description'],
            $data['gender'],
            $id
        ]);
    }


    public function delete($pdo, $id)
    {
        $doctor = self::findById($pdo, $id);

        // delete doctor row
        $doctorQuery = "DELETE FROM doctors WHERE id = ?";

        $stmt = $pdo->prepare($doctorQuery);
        $stmt->execute([$id]);


        // delete user row
        $userQuery = "DELETE FROM users WHERE id = ?";

        $userStmt = $pdo->prepare($userQuery);

        return $userStmt->execute([$doctor['user_id']]);
    }
}