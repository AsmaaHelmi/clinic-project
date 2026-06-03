<?php
namespace App\Models;

use App\traits\ManageFiles;
use PDO;

class Major
{

    public int $id;
    public string $title;
    public string $description;
    public ?string $image;

    public function __construct($id, $title, $description, $image = null)
    {

        $this->id          = $id;
        $this->title       = $title;
        $this->description = $description;
        $this->image       = $image;

    }
    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getImage()
    {
        return $this->image;
    }
    //-----------

    public static function create(PDO $pdo, string $title, string $description, ?array $image = null)
    {
        $imageName = '';

        if ($image && is_array($image)) {

            $imageName = ManageFiles::uploadImage(
                $image,
                "majors"
            );

        }

        $sql     = "INSERT INTO `majors` (title,description,image) VALUES(?,?,?)";
        $statm   = $pdo->prepare($sql);
        $success = $statm->execute([$title, $description, $imageName]);

        if ($success) {
            $id = $pdo->lastInsertId();
            return new self($id, $title, $description, $imageName);

        }

    }

    public static function getAll(PDO $pdo)
    {
        $sql    = $pdo->query("SELECT * from majors");
        $rows   = $sql->fetchAll(PDO::FETCH_ASSOC);
        $majors = [];
        foreach ($rows as $major) {
            $majors[] = new self($major['id'], $major['title'], $major['description'], $major['image']);
        }
        return $majors;
    }
    public static function findById(PDO $pdo, int $id)
    {
        $sql   = "SELECT * from `majors` WHERE id=?";
        $statm = $pdo->prepare($sql);
        $statm->execute([$id]);
        $row = $statm->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new self($row['id'], $row['title'], $row['description'], $row['image']);

        }

    }
    public static function update(PDO $pdo, int $id, string $title, string $description)
    {
        $sql   = "UPDATE `majors` SET title=?,description=? Where id=?";
        $statm = $pdo->prepare($sql);
        return $statm->execute([$title, $description, $id]);

    }

    public static function delete(PDO $pdo, int $id)
    {
        $sql   = "DELETE FROM majors WHERE id=?";
        $statm = $pdo->prepare($sql);
        return $statm->execute([$id]);

    }

}
