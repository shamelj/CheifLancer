<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/CheifLancer/API/objects/factories/UserFactory.php";

try{
    $accData = json_decode(file_get_contents("php://input"));
    $conn = Database::getConnection();
    if ($accData->type == "cook"){
        $insertCookSQL = "call insert_cook(:username,:password,:email,:firstName,:lastName,:phone,:picture,:location);";
        $stmt = $conn->prepare($insertCookSQL);
        $stmt->execute( array( ':username' => $accData->username, ':password' => $accData->password ,':email'=>$accData->email,':firstName' =>$accData->firstName
        ,':lastName' => $accData->lastName,':phone' => $accData->phone,':picture' => $accData->picture,':location' => $accData->location) );
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
    }
    else{
        $insertCustomerSQL = "call insert_customer(:username,:password,:email,:firstName,:lastName,:phone,:picture);";
        $stmt = $conn->prepare($insertCustomerSQL);
        $stmt->execute( array( ':username' => $accData->username, ':password' => $accData->password ,':email' => $accData->email,':firstName' =>$accData->firstName
        ,':lastName' => $accData->lastName,':phone' => $accData->phone,':picture' => $accData->picture) );
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
    }
    echo json_encode( array('status'=>'200') );
}catch(Exception $e){
    echo json_encode( array('status'=>'400','body'=> "User already exists" ) );
}

//echo json_encode( array('hola'=>'hey'));