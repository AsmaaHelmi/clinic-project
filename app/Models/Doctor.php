<?php

namespace App\Models;

use PDO;

class Doctor
{

    private int $id;
    private int $user_id;
    private int $major_id;
    private string $phone;
    private string $image;
    private string $description;

    private string $name;
    private string $major_title;


    public function __construct(
        int $id,
        int $user_id,
        int $major_id,
        string $phone,
        string $image,
        string $description,
        string $name = '',
        string $major_title = ''
    ) {

        $this->id = $id;
        $this->user_id = $user_id;
        $this->major_id = $major_id;

        $this->phone = $phone;
        $this->image = $image;
        $this->description = $description;

        $this->name = $name;
        $this->major_title = $major_title;
    }


    // ===== GETTERS =====

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getMajorId(): int
    {
        return $this->major_id;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMajorTitle(): string
    {
        return $this->major_title;
    }


    // ===== GET ALL =====

    public static function getAll(PDO $pdo): array
    {

        $sql = "

        SELECT
            doctors.*,
            users.name,
            majors.title AS major_title

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
                $doctor['description'],
                $doctor['name'],
                $doctor['major_title']

            );
        }

        return $doctors;
    }


    // ===== FIND BY ID =====

    public static function findById(PDO $pdo, int $id): ?Doctor
    {

        $sql = "

        SELECT
            doctors.*,
            users.name,
            majors.title AS major_title

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

        if (!$doctor) {

            return null;

        }

        return new self(

            $doctor['id'],
            $doctor['user_id'],
            $doctor['major_id'],
            $doctor['phone'],
            $doctor['image'],
            $doctor['description'],
            $doctor['name'],
            $doctor['major_title']

        );
    }


    // ===== DELETE =====

    public static function delete(PDO $pdo, int $id): bool
    {

        $doctor = self::findById($pdo, $id);

        if (!$doctor) {

            return false;

        }

        $doctorSql = "DELETE FROM doctors WHERE id = ?";

        $doctorStmt = $pdo->prepare($doctorSql);

        $doctorStmt->execute([$id]);


        $userSql = "DELETE FROM users WHERE id = ?";

        $userStmt = $pdo->prepare($userSql);

        return $userStmt->execute([
            $doctor->getUserId()
        ]);
    }
}