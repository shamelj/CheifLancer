addMeal = (cookName,mealname,description,price,waitingTime,arrayOfPics) => {
 
    const meal = document.createElement("div");
    const div = document.createElement("div");
    const Name = document.createElement("p");
    const mealn = document.createElement("p");
    const desc = document.createElement("p");
    meal.className = "meal";
    Name.textContent = cookName;
    mealn.textContent = mealname;
   desc .textContent = description;

    
    meal.appendChild(div);
    meal.appendChild(mealn);
    meal.appendChild(Name);



    document.querySelector("#meals").appendChild(meal);
}