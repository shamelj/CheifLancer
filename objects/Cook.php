<?php
require_once './User.php';
public class Cook extends User{
    public $location;
    
    public static function type():string{
        return "Cook";
    }

    protected function toArray(){
        $tbr = parent::toArray();
        $tbr["location"] = $this->location;
    }

}