<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/CheifLancer/API/objects/factories/UserFactory.php";

try{
    //$accData = json_decode(file_get_contents("php://input"));
    $accData = (object)($_POST);
    $conn = Database::getConnection();
    if ($accData->type == "cook"){
        $insertCookSQL = "call insert_cook(:username,:password,:email,:firstName,:lastName,:phone,:picture,:location);";
        $stmt = $conn->prepare($insertCookSQL);
        $stmt->execute( array( ':username' => $accData->username, ':password' => $accData->password ,':email'=>$accData->email,':firstName' =>$accData->firstName
        ,':lastName' => $accData->lastName,':phone' => $accData->phone,':picture' => '',':location' => $accData->location) );
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
    }
    else{
        $insertCustomerSQL = "call insert_customer(:username,:password,:email,:firstName,:lastName,:phone,:picture);";
        $stmt = $conn->prepare($insertCustomerSQL);
        $stmt->execute( array( ':username' => $accData->username, ':password' => $accData->password ,':email' => $accData->email,':firstName' =>$accData->firstName
        ,':lastName' => $accData->lastName,':phone' => $accData->phone,':picture' => '') );
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
    }
    $pic_path = upload_pic_to_database();
    if (isset($pic_path))
        insert_pic_path_to_database($accData->username,$pic_path);
    echo json_encode( array('status'=>'200') );
    
}catch(Exception $e){
    echo json_encode( array('status'=>'400','body'=> "User already exists" ) );
}
function upload_pic_to_database(){
    if (isset($_FILES['picture'])){
        $tmp = explode('.',$_FILES['picture']['name']);
        $file_ext = strtolower(end($tmp));
        $req_time = $_SERVER['REQUEST_TIME'];
        $pictures_path = 'C:\xampp\htdocs\CheifLancer\Database\Profile_Pictures\\';
        $temp_path = $_FILES['picture']['tmp_name'];
        $dest_path =$pictures_path.$req_time.'.'.$file_ext;
        move_uploaded_file($temp_path,$dest_path);
        return $req_time.'.'.$file_ext;
    }
    return null;
}
function insert_pic_path_to_database($username,$path){
    try{
        $conn = Database::getConnection();
        $insertPicPath = "call update_picture(:username,:picture);";
        $stmt = $conn->prepare($insertPicPath);
        $stmt->execute( array( ':username' => $username, ':picture' => $path) );
    }catch(Exception $e){
    }
}

//echo json_encode( array('hola'=>'hey'));