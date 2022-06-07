<?php

require_once "C:\\xampp\htdocs\CheifLancer\API\objects\\factories\MealFactory.php";

try{
    if(!isset($_COOKIE)){
        echo json_encode( array('state'=>'NOT_LOGGED' ) );
        die();
    }
    $user = json_decode($_COOKIE['user']);
    $meals = MealFactory::getCookMeals( $user->username );
    $tbr=[];
    foreach ($meals as $meal){
        array_push($tbr, $meal->toArray());
    }
    
    echo json_encode( array('state'=>'ACCEPTED', 'body'=>$tbr));
                        
}catch(Exception $e){
    echo json_encode(array('state'=>'ERROR'));
}