<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/CheifLancer/API/objects/factories/UserFactory.php";
$users = UserFactory::getAllUsers();
echo json_encode($users);
