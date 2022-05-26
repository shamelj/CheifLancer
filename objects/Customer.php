<?php
require_once './User.php';

public class Customer extends User{
    
    public static function type():string{
        return "Customer";
    }

}