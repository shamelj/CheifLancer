<?php
require_once "C:\\xampp\htdocs\CheifLancer\API\config\config.php";
require_once "C:\\xampp\htdocs\CheifLancer\API\objects\Customer.php";
require_once "C:\\xampp\htdocs\CheifLancer\API\objects\Cook.php";
class UserFactory{
    private function __construct(){}

    public static function getUser(string $username, string $password) {
        try {
            $conn = Database::getConnection();
            $getCookSQL = "select * from user natural join cook where username= :username AND pass= :password";
            $getCustomerSQL = "select * from user natural join customer where username= :username AND pass= :password";
            $stmt = $conn->prepare($getCookSQL);
            $stmt->execute( array( ':username' => $username, ':password' => $password ) );
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
            if($result){    //is a cook
                $tbr = new Cook($result['email'], $result['first_name'], $result['last_name'], 
                $result['pass'], $result['phone_number'], $result['profile_img']);
                $tbr->location = $result['location'];
                return $tbr;
            }

            $stmt = $conn->prepare($getCustomerSQL);
            $result = $stmt->fetch();
            if($result){
                $tbr = new Customer($result['email'], $result['first_name'], $result['last_name'], 
                $result['pass'], $result['phone_number'], $result['profile_img']);
                return $tbr;
            }
            return false;

        } catch (PDOException $e) {
            return false;
        }
    }

}