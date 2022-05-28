<?php
include_once "C:\\xampp\htdocs\CheifLancer\API\objects\User.php";
class Cook extends User{
    public $location;
    
    public static function type():string{
        return "Cook";
    }

    protected function toArray():array{
        $tbr = parent::toArray();
        $tbr["location"] = $this->location;
    }

}