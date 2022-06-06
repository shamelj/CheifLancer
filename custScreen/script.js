//addMeal = (cookName,mealname,mprice,description,waitingT,arrImg)

async function showMeals(){
    
    const massage = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({})
    };
    //send the massage and get the response
    let response = await fetch("/CheifLancer/API/get_recommended_meals.php", massage);
    let data = await response.json();
    let meals = data.body;

    for(const  meal of meals){
        //check attributes' names
        addMeal(meal.cookUsername, meal.name, meal.price, meal.description, meal.waitingTime, meal.pictures);
    }

}

window.onload = function (){

    let user=JSON.parse(document.cookie.split('=')[1]);
    console.log(user);
    document.getElementById('profile_img').src = user.profileImage;
    showMeals();
};
