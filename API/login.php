<?php

require_once "C:\\xampp\htdocs\CheifLancer\API\objects\\factories\UserFactory.php";

try{
    $accData = json_decode(file_get_contents("php://input"));
    $user = UserFactory::getUser($accData->username, $accData->password);
    if($user){
        echo json_encode( array('state'=>'ACCEPTED', 'body'=> $user->toArray() ) );
        //setcookie("user", json_encode($user->toArray()), time()+3600 );
        //specify cookie path
    }else{
        echo json_encode( array('state' => 'NO_MATCH', 'body' => array(null=>null) ) );
    }
}catch(Exception $e){
    echo $e->getMessage();
}
