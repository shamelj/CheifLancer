<?php

require_once "objects/factories/UserFactory.php";
/*
try{
    $accData = json_decode(file_get_contents("php://input"));
    $user = UserFactory::getUser($accData->username, $accData->password);
    if($user){
        echo json_encode( array('state'=>'ACCEPTED','body'=> $user ) );
    }else{
        echo json_encode( array('state' => 'ACCEPTED', 'body' => array() ) );
    }
}catch(Exception $e){
    //echo $e->getMessage();
}
*/
//echo json_encode( array('hola'=>'hey'));