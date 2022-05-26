<?php
require_once ".../config/config.php";
require_once "../Customer.php";
require_once "../Cook.php";

public class UserFactory{
    private __construct(){}

    public static getUser(string $username, string $password) {
        try {
            $conn = Database::getConnection();
            $stmt->execute( array( ':username' => $username, ':password' => $password ) );
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $getCookSQL = "select * from user natural join cook where username= :username AND pass= :password";
            $getCustomerSQL = "select * from user natural join customer where username= :username AND pass= :password";
            $stmt = $conn->prepare($getCookSQL);


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