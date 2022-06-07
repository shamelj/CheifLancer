<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/CheifLancer/API/objects/factories/UserFactory.php";
$usersObjects = UserFactory::getAllUsers();
$users = [];
foreach($usersObjects as $user)
    array_push($users,$user->toArray());
echo json_encode($users);
