<?php
require_once "C:\\xampp\htdocs\CheifLancer\API\objects\\factories\UserFactory.php";
$temp_users = UserFactory::getAllUsers();
$users = [];
foreach($temp_users as $user)
array_push($users,$user.toArra);
