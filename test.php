<?php
require_once "config/config.php";
/*
$username='moawyah';
$password='123456789';

$conn = Database::getConnection();
$sql = "select * from user where username= :username AND pass= :password";
$stmt = $conn->prepare($sql);
$stmt->execute([':username' => $username,':password'=>$password]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);

$result = $stmt->fetch();

foreach($result as $att=>$val){
    echo "$att\t\t";
}

echo "<br>";
foreach($result as $val){
    echo "$val\t\t";
}
*/

$accData = json_decode(file_get_contents("php://input"));

//$massage = array('state'=>'ACCEPTED','body'=> array("username"=>$accData->username, password=>$accData->password ) );
//echo json_encode($massage);
echo json_encode(array('a'=>'gg'));