<?php

require_once "C:\\xampp\htdocs\CheifLancer\API\objects\\factories\UserFactory.php";
$admin = ['username'=>'admin','password'=>'admin'];
try{
    $accData = json_decode(file_get_contents("php://input"));
    if($accData->username == $admin['username'] &&$accData->password == $admin['password'] ){
        echo json_encode( array('state'=>'ACCEPTED' ) );
    }else{
        echo json_encode( array('state' => 'NO_MATCH') );
    }
}catch(Exception $e){
    echo $e->getMessage();
}
