<?php
require_once "C:\\xampp\htdocs\CheifLancer\API\config\config.php";
require_once "C:\\xampp\htdocs\CheifLancer\API\objects\Meal.php";

class MealFactory{
    private function __construct(){}

    private static function uniqueRandomNumbers($min, $max, $quantity):array {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }
    private static function toMealInstance(array $row):Meal {
        return new Meal($row['name'], $row['cook_username'], $row['description'], $row['price'],
                     $row['waiting_time'], []);
    }

    public static function getRecommendedMeals(string $customerUsername ): array{
        try{
            $conn = Database::getConnection();
            $sql = "call get_recommended_meals_for(:username)";
            $stmt = $conn->prepare($sql);
            $stmt->execute( array( ':username' => $customerUsername ) );
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            $allRecords=[];
            while($row=$stmt->fetch()){
                array_push($allRecords, self::toMealInstance($row)->toArray() );
            }
            $tbr = [];
            foreach(MealFactory::uniqueRandomNumbers(0,count($allRecords),10) as $index){
                array_push( $tbr, $allRecords[$index] );
            }
            return $tbr;
        }catch(Exception $e){
            //echo $e->getMessage();
        }
        return [];
    }
}