<?php
abstract class User{
    private $email;
    private $firstName;
    private $lastName;
    private $password;
    private $phoneNumber;
    private $profileImage;
    
    
    public function __construct($email, $firstName, $lastName, $password, $phoneNumber, $profileImage){
        $this->email = $email;
        $this->firstName=$firstName;
        $this->$lastName=$lastName;
        $this->password=$password;
        $this->$phoneNumber=$phoneNumber;
        $this->profileImage=$profileImage;
    }

    public static abstract function type():string;

    protected function toArray():array{
        return array(
            "email"=>$email,
            "firstName"=>$firstName,
            "lastName"=>$lastName,
            "password"=>$password,
            "phoneNumber"=>$phoneNumber,
            "profileImage"=>$profileImage,
            "type"=> type(),
        );
    }
    
}