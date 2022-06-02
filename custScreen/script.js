//addMeal = (cookName,mealname,mprice,description,waitingT,arrImg)

async function showMeals(){
    console.log("ayyoooo niggerrrsss");
    
    const massage = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({})
    };
    //send the massage and get the response
    let response = await fetch("/CheifLancer/API/get_recommended_meals.php", massage);
    let data = await response.json();
    let meals = data.body;

    console.log(meals);
    for(const  meal of meals){
        //check attributes' names
        addMeal(meal.cookUsername, meal.name, meal.price, meal.description, meal.waitingTime, meal.pictures);
    }

}

window.onload = showMeals;
