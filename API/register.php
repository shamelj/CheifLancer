<?php
echo $_SERVER['DOCUMENT_ROOT'];

require_once "C:\\xampp\htdocs\CheifLancer\API\objects\\factories\UserFactory.php";

try{
    $accData = json_decode(file_get_contents("php://input"),true);
    $user = UserFactory::getUser($accData->username, $accData->password);
    if($user){
        echo json_encode( array('status'=>'200','body'=> "User already exists" ) );
    }else{
        echo json_encode( array('state' => 'ACCEPTED', 'body' => array() ) );
    }
}catch(Exception $e){
    //echo $e->getMessage();
}

//echo json_encode( array('hola'=>'hey'));