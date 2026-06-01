<?php
namespace App\Models;

use App\traits\ManageFiles;
use PDO;

class Doctor
{

    private int $id;
    private int $user_id;
    private int $major_id;

    private string $phone;
    private string $description;

    private ?string $image;

    private string $name;
    private string $email;
    private string $password;

    private string $major_title;

    public function __construct(

        int $id,
        int $user_id,
        int $major_id,

        string $phone,
        string $description,

        string $name = '',
        string $email = '',
        string $password = '',

        string $major_title = '',

        ?string $image = null

    ) {

        $this->id = $id;

        $this->user_id  = $user_id;
        $this->major_id = $major_id;

        $this->phone       = $phone;
        $this->description = $description;

        $this->image = $image;

        $this->name     = $name;
        $this->email    = $email;
        $this->password = $password;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getMajorTitle(): string
    {
        return $this->major_title;
    }

    // ===== CREATE =====

    public static function create(

        PDO $pdo,

        int $user_id,
        int $major_id,

        string $phone,
        string $description,

        ?array $image = null

    ): ?Doctor {

        $imageName = '';

        if ($image && is_array($image)) {

            $imageName = ManageFiles::uploadImage(
                $image,
                "doctors"
            );
        }

        $sql = "

        INSERT INTO doctors

        (
            user_id,
            major_id,
            phone,
            image,
            description
        )

        VALUES (?, ?, ?, ?, ?)

        ";

        $stmt = $pdo->prepare($sql);

        $result = $stmt->execute([

            $user_id,
            $major_id,

            $phone,
            $imageName,

            $description,

        ]);

        if (! $result) {

            return null;

        }

        $id = $pdo->lastInsertId();

        return self::findById($pdo, $id);
    }

    // ===== GET ALL =====

    public static function getAll(PDO $pdo): array
    {

        $sql = "

        SELECT
            doctors.*,
            users.name,
            users.email,
            users.password,
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
                $doctor['description'],

                $doctor['name'],
                $doctor['email'],
                $doctor['password'],

                $doctor['major_title'],

                $doctor['image']

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
            users.email,
            users.password,
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

        if (! $doctor) {

            return null;

        }

        return new self(

            $doctor['id'],
            $doctor['user_id'],
            $doctor['major_id'],

            $doctor['phone'],
            $doctor['description'],

            $doctor['name'],
            $doctor['email'],
            $doctor['password'],

            $doctor['major_title'],

            $doctor['image']

        );
    }

    // ===== UPDATE =====

    public static function update(

        PDO $pdo,
        int $id,

        int $major_id,
        string $phone,

        string $description,
        string $image = ''

    ): bool {

        $sql = "

        UPDATE doctors

        SET

            major_id = ?,
            phone = ?,
            image = ?,
            description = ?

        WHERE id = ?

        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([

            $major_id,

            $phone,
            $image,

            $description,

            $id,

        ]);
    }

    // ===== DELETE =====

    public static function delete(PDO $pdo, int $id): bool
    {

        $doctor = self::findById($pdo, $id);

        if (! $doctor) {

            return false;

        }

        $doctorSql = "

        DELETE FROM doctors

        WHERE id = ?

        ";

        $doctorStmt = $pdo->prepare($doctorSql);

        $doctorStmt->execute([$id]);

        $userSql = "

        DELETE FROM users

        WHERE id = ?

        ";

        $userStmt = $pdo->prepare($userSql);

        return $userStmt->execute([

            $doctor->getUserId(),

        ]);
    }

    public static function getByMajor(PDO $pdo, int $majorId): array
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

        WHERE doctors.major_id = ?

    ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([$majorId]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $doctors = [];

        foreach ($rows as $doctor) {

            $doctors[] = new self(

                $doctor['id'],
                $doctor['user_id'],
                $doctor['major_id'],

                $doctor['phone'],
                $doctor['description'],

                $doctor['name'],
                $doctor['email'] ?? '',
                $doctor['password'] ?? '',

                $doctor['major_title'],

                $doctor['image']

            );

        }

        return $doctors;

    }

}
