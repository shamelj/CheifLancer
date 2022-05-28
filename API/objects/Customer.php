<?php
include_once "C:\\xampp\htdocs\CheifLancer\API\objects\User.php";

class Customer extends User{
    
    public static function type():string{
        return "Customer";
    }

}