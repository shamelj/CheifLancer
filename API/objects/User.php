<?php
abstract class User{
    private string $username;
    private string $email;
    private string $firstName;
    private string $lastName;
    private string $password;
    private string $phoneNumber;
    private $profileImage;
    
    
    public function __construct(string $username, string $email, string $firstName, string $lastName,
    string $password, string $phoneNumber, $profileImage){
        $this->email = $email;
        $this->username = $username;
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->password=$password;
        $this->phoneNumber=$phoneNumber;
        $this->profileImage=$profileImage;
    }
    
    public function update(string $email, string $firstName, string $lastName,
    string $password, string $phoneNumber, $profileImage){
        $this->email = $email;
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->password=$password;
        $this->phoneNumber=$phoneNumber;
        $this->profileImage=$profileImage;
        return $this->commit();
    }
    public function commit(){
        try{
            $conn = Database::getConnection();
            $getUsersSQL = 'call update_user(:username, :password, :email, :firstName, :lastName, :phone, :img)';
            $stmt = $conn->prepare($getUsersSQL);
            $stmt->execute(array(':username' => $this->username,':password'=>$this->password, ':email' => $this->email,
                                        ':firstName'=>$this->firstName,':lastName' =>$this->lastName, ':phone'=>$this->phoneNumber, ':img'=>$this->profileImage  ));        
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            return true;
        }
            catch (PDOException $e) {
                return false;
            }
    }
    public static abstract function type():string;

    public function toArray():array{
        return array(
            "username"=>$this->username,
            "email"=>$this->email,
            "firstName"=>$this->firstName,
            "lastName"=>$this->lastName,
            "password"=>$this->password,
            "phoneNumber"=>$this->phoneNumber,
            "profileImage"=>$this->profileImage,
            "type"=> static::type(),
        );
    }
    
    public function getUsername(): string{
        return $this->username;
    }
    public function getEmail(): string{
        return $this->email;
    }
    public function getFirstName(): string{
        return $this->firstName;
    }
    public function getLastName(): string{
        return $this->lastName;
    }
    public function getPassword(): string{
        return $this->password;
    }
    public function getPhoneNumber(): string{
        return $this->phoneNumber;
    }
    public function getProfileImage(){
        return $this->profileImage;
    }
}