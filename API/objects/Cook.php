<?php
include_once "C:\\xampp\htdocs\CheifLancer\API\objects\User.php";
class Cook extends User{
    public $location;
    
    public static function type():string{
        return "Cook";
    }


}