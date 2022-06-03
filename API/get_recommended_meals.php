<?php
require_once "C:\\xampp\htdocs\CheifLancer\API\objects\\factories\MealFactory.php";

try{
    if(!isset($_COOKIE)){
        echo json_encode( array('state'=>'NOT_LOGGED' ) );
        die();
    }
        echo json_encode( array('state'=>'ACCEPTED', 
                        'body'=>MealFactory::getRecommendedMeals(  $_COOKIE['user'] )));
                        
}catch(Exception $e){
    echo json_encode(array('state'=>'ERROR'));
}