<?php
namespace App\traits;

trait ManageFiles{

    public static function uploadImage(array $file, ?string $uploadfolder = null)
    {
        $folderpath = __DIR__ . "/../../public/assets/images";

        if ($uploadfolder) {
            $folderpath .= "/" . $uploadfolder;
        }

        if (!is_dir($folderpath)) {
            mkdir($folderpath, 0777, true);
        }

        $imageName = time() . "_" . $file['name'];

        $fullpath = $folderpath . "/" . $imageName;

        if (move_uploaded_file($file['tmp_name'], $fullpath)) {

            return "public/assets/images/"
                . ($uploadfolder ? $uploadfolder . "/" : "")
                . $imageName;
        }

        return null;
    }
}
