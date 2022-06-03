<?php
class Meal{
    private string $name;
    private string $cookUsername;
    private string $description;
    private float $price;
    private $waitingTime;
    private array $pictures;
    
    public function __construct(string $name, string $cookUsername, string $description,
    float $price, $waitingTime, array $pictures){
        $this->name=$name;
        $this->cookUsername=$cookUsername;
        $this->description=$description;
        $this->price=$price;
        $this->waitingTime=$waitingTime;
        $this->pictures=$pictures;
    }
    
    public function toArray():array {
        return array(
            "name"=>$this->name,
            "cookUsername"=>$this->cookUsername,
            "description"=>$this->description,
            "price"=>$this->price,
            "waitingTime"=>$this->waitingTime,
            "pictures"=>$this->pictures,
        );
    }

    public function addPicture($pic){
        array_push($this->pictures, $pic);
    }

    public function getName():string {
        return $this->name;
    }
    public function getCookUsername():string {
        return $this->cookUsername;
    }
    public function getDescription():string {
        return $this->description;
    }
    public function getPrice():string {
        return $this->price;
    }
    public function getWaitingTime() {
        return $this->waitingTime;
    }
    public function getPictures():array {
        return $this->pictures;
    }
}