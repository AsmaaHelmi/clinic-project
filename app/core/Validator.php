<<<<<<< HEAD
<?php

class Validator{
    private $errors=[];
public function required(string $value,string $fieldName){
    if(empty($value)){
        //array_push(array,msg)
       // array_push($this->errors,"this $fieldName must be greater than $minValue");push indexed
        
        array_push($this->errors,[$fieldName=>"this $fieldName is required"]);
    }

}
public function minValue(string $value,string $fieldName,int $minValue){
    if(strlen($value)<=$minValue){
        $this->errors[]=[$fieldName=>"this $fieldName must be greater than $minValue"];

    }
}
public function maxValue(string $value,string $fieldName,int $maxValue){
    if(strlen($value)>=$maxValue){
        $this->errors[]=[$fieldName=>"this $fieldName must be less than $maxValue"];
    }}
public function validateEmail(string $value){
    if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
        $this->errors=["email"=>"is invalid!"];

    }
}
public function length(string $value,string $fieldName,int $length){
    if(strlen($value!=$length)){
        $this->errors[]=[$fieldName=>"this $fieldName must be $length digits"];
    }}
    public function validatePassword(string $password){
        $pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$^";
        if(!preg_match($pattern,$password)){
            $this->errors[]=[$password=>"\n mustcontain 8 characters\n must contain uppercase characters\n must contain lowercase characters
            \n must contain numbers \n must contain special characters"];

        }
       
    }
     public function confirmed(string $value,string $confirmed_value,string $fieldName){
        if($confirmed_value!=$value){
        $this->errors[]=[$fieldName=>"this $confirmed_value must = $value "];

        }
     }







    public function validateURL(string $value){
    if(!filter_var($value,FILTER_VALIDATE_URL)){
                $this->errors[]=[$fieldName=>"this $fieldName must be valid link"];


    }
}
public function getErrors(){
    return $this->errors;
}}
$validator=new Validator();

















=======
<?php
namespace App\core;
class Validator{
    private $errors=[];
public function required(string $value,string $fieldName){
    if(empty($value)){
        //array_push(array,msg)
       // array_push($this->errors,"this $fieldName must be greater than $minValue");push indexed
        
        array_push($this->errors,[$fieldName=>"this $fieldName is required"]);
    }

}
public function minValue(string $value,string $fieldName,int $minValue){
    if(strlen($value)<=$minValue){
        $this->errors[]=[$fieldName=>"this $fieldName must be greater than $minValue"];

    }
}
public function maxValue(string $value,string $fieldName,int $maxValue){
    if(strlen($value)>=$maxValue){
        $this->errors[]=[$fieldName=>"this $fieldName must be less than $maxValue"];
    }}
public function validateEmail(string $value){
    if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
        $this->errors=["email"=>"is invalid!"];

    }
}
public function length(string $value,string $fieldName,int $length){
    if(strlen($value!=$length)){
        $this->errors[]=[$fieldName=>"this $fieldName must be $length digits"];
    }}
    public function validatePassword(string $password){
        $pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$^";
        if(!preg_match($pattern,$password)){
            $this->errors[]=[$password=>"\n mustcontain 8 characters\n must contain uppercase characters\n must contain lowercase characters
            \n must contain numbers \n must contain special characters"];

        }
       
    }
     public function confirmed(string $value,string $confirmed_value,string $fieldName){
        if($confirmed_value!=$value){
        $this->errors[]=[$fieldName=>"this $confirmed_value must = $value "];

        }
     }







    public function validateURL(string $value){
    if(!filter_var($value,FILTER_VALIDATE_URL)){
                $this->errors[]=[$fieldName=>"this $fieldName must be valid link"];


    }
}
public function getErrors(){
    return $this->errors;
}}
//$validator=new Validator();

















>>>>>>> develop
?>