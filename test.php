<?php
require_once "C:\\xampp\htdocs\CheifLancer\API\objects\\factories\MealFactory.php";

$meals = MealFactory::getRecommendedMeals("moawyah");
$tbr=[];
foreach ($meals as $meal){
    array_push($tbr, $meal->toArray());
}
echo json_encode($tbr);
