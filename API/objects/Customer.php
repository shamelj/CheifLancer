<?php
include_once 'User.php';

class Customer extends User{
    
    public static function type():string{
        return "Customer";
    }

}