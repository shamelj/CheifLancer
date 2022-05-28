let cook ='abu zant';
let me='la7em 7alal';
let de='very good lahem yes very nice yyyeees yeeees';
let price ='55$';
let waitingT='16 days';
let arrImage =['https://www.eatthis.com/wp-content/uploads/sites/4/2020/12/unhealthiest-foods-planet.jpg?quality=82&strip=1&w=640','https://www.eatthis.com/wp-content/uploads/sites/4/2020/12/unhealthiest-foods-planet.jpg?quality=82&strip=1&w=640'];
addMeal = (cookName,mealname,mprice,description,waitingT,arrImg) => {
    
    const meal = document.createElement("div");
    const pic = document.createElement("div");
    const pic1 = document.createElement("div");
    const pic2 = document.createElement("div");
    const details = document.createElement("div");
    const name = document.createElement("p");
    const price = document.createElement("p");
    const mealn = document.createElement("p");
    const desc = document.createElement("p");
    const waitingTime = document.createElement("p");
    details.className="details";
    meal.className = "meal";
    pic.className="pic";
    pic1.className="pic1";
    pic2.className="pic2";
    pic1.style.backgroundImage="url('"+arrImg[0]+"')";
    if(arrImg[1]!=null){
    pic.appendChild(pic2);
     pic2.style.backgroundImage="url('"+arrImg[1]+"')";
    }
    name.textContent = cookName;
    price.textContent=mprice;
    mealn.textContent = mealname;
    desc.textContent  = description;
    waitingTime.textContent =waitingT;

    pic.appendChild(pic1);
    meal.appendChild(pic);
    details.appendChild(mealn);
    details.appendChild(desc);
    details.appendChild(price);
    details.appendChild(name);
    details.appendChild(waitingTime);

    meal.appendChild(details);
    document.querySelector("#meals").appendChild(meal);
}
addMeal(cook,me,price,de,waitingT,arrImage);


