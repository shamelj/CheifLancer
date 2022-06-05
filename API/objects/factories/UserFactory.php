<?php
require_once "C:\\xampp\htdocs\CheifLancer\API\config\config.php";
require_once "C:\\xampp\htdocs\CheifLancer\API\objects\Customer.php";
require_once "C:\\xampp\htdocs\CheifLancer\API\objects\Cook.php";
class UserFactory{
    private function __construct(){}

    public static function getUser(string $username, string $password) {
        try {
            $conn = Database::getConnection();
            $getCookSQL = "select username, pass, email, first_name, last_name, phone_number, profile_img, location ".
            "from user natural join cook ".
            "where username= :username AND pass= :password";

            $getCustomerSQL = "select username, pass, email, first_name, last_name, phone_number, profile_img ".
            "from user natural join customer ".
            "where username= :username AND pass= :password";
            $stmt = $conn->prepare($getCookSQL);
            $stmt->execute( array( ':username' => $username, ':password' => $password ) );
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
            if($result){    //is a cook
                $tbr = new Cook($result['username'], $result['email'], $result['first_name'], $result['last_name'], 
                $result['pass'], $result['phone_number'], $result['profile_img']);
                $tbr->location = $result['location'];
                return $tbr;
            }
            $stmt = $conn->prepare($getCustomerSQL);
            $stmt->execute( array( ':username' => $username, ':password' => $password ) );
            $result = $stmt->fetch();
            if($result){    
                $tbr = new Customer($result['username'], $result['email'], $result['first_name'], $result['last_name'], 
                $result['pass'], $result['phone_number'], $result['profile_img']);
                return $tbr;
            }
            return false;

        } catch (PDOException $e) {
            return false;
        }
    }
    public static function getAllUsers(){
        try{
        $conn = Database::getConnection();
        $getUsersSQL = 'call get_users()';
        $stmt = $conn->query($getUsersSQL);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $users  = [];
        foreach ($stmt as $row){
            array_push($users,$row);
        }
        return $users;}
        catch (PDOException $e) {
            return false;
        }
    }

}