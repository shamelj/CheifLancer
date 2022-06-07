<?php
require_once "C:\\xampp\htdocs\CheifLancer\API\objects\\factories\UserFactory.php";
try{
    //$accData = json_decode(file_get_contents("php://input"));
    $accData = $_POST;
    $conn = Database::getConnection();
    $user = new Customer($accData['username'],
    $accData['email'],
    $accData['firstName'],
    $accData['lastName'],
    $accData['password'],
    $accData['phone'],
    $accData['picture']);
    $pic_path = upload_pic_to_database();
    if (isset($pic_path))
        $accData['picture'] = $pic_path;
    $user->update($accData['email'],$accData['firstName'],$accData['lastName'],$accData['password'],$accData['phone'],$accData['picture']);
    echo json_encode( array('status'=>'200') );
    
}catch(Exception $e){
    echo json_encode( array('status'=>'400','body'=> "Unknwon server error" ) );
}
function upload_pic_to_database(){
    if ($_FILES['picture']['tmp_name']!=''){
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