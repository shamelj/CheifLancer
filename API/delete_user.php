<?php

require_once "C:\\xampp\htdocs\CheifLancer\API\config\config.php";

try{
    $accData = json_decode(file_get_contents("php://input"));
    $conn = Database::getConnection();
    $insertCookSQL = "call delete_user(:username);";
    $stmt = $conn->prepare($insertCookSQL);
    $stmt->execute( array( ':username' => $accData->username));
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
    echo $result;
    echo json_encode( array('status'=>'200') );
}catch(Exception $e){
    echo json_encode( array('status'=>'400','body'=> "Error occured"));
}

//echo json_encode( array('hola'=>'hey'));