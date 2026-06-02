<?php
namespace App\traits;
trait ManageFiles{
    public static $uploadDir="public/assets/images";
    public static function uploadImage(array $file, ?string $uploadfolder=null){
        $realpath = realpath(__DIR__ . "/../../")
            . "/" . self::$uploadDir;

    
        if(isset($uploadfolder)){
            $folderpath=$realpath.$uploadfolder;
        }else{
            $folderpath=$realpath;
        }
        if(!is_dir($folderpath)){
            mkdir($folderpath,0775,true);
        }
        $fullpath=$folderpath. "/" . $file['name'];
        if(move_uploaded_file($file['tmp_name'],$fullpath)){
               return self::$uploadDir . "/" . $uploadfolder . "/" . $file['name'];
        }
        return null;

    }
}
