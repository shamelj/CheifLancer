<?php

require_once "./objects/factories/UserFactory.php";

$accData = json_decode(file_get_contents("php://input"));
$user = UserFactory::getUser($accData->usernameو $accData->password);
echo $user->toJSON();