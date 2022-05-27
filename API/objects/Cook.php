<?php
include_once 'User.php';
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