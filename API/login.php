<?php
require_once "/config/config.php";
require_once "/";

$accData = json_decode(file_get_contents("php://input"));
$user = UserFactory::getUser($accData->usernameو $accData->password);
echo $user->toJSON();