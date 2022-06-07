
addMeal = (cookName, mealname, mprice, description, waitingT, arrImg) => {
    
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
    details.className = "details";
    meal.className = "meal";
    pic.className = "pic";
    pic1.className = "pic1";
    pic2.className = "pic2";
    name.className = "name";
    price.className = "price";
    mealn.className = "mealn";

    mealn.style.fontSize = "22";
    mealn.style.fontWeight = "bold";
    price.style.fontSize = "45"

    if (arrImg.length>0) {
        pic1.style.backgroundImage = "url('/CheifLancer/Database/Profile_Pictures/" + arrImg[0] + "')";
        pic1.style.backgroundRepeat = 'no-repeat'
        if (arrImg[1] != null) {
            pic2.style.background = "url('/CheifLancer/Database/Profile_Pictures/" + arrImg[1] + "')";
            pic2.style.backgroundRepeat = 'no-repeat';
            pic.appendChild(pic2);
        }
    }
    name.textContent = "Cheif :" + cookName;
    price.textContent = mprice;
    mealn.textContent = mealname;
    desc.textContent = description;
    waitingTime.textContent = "order is deliverd in less than" + waitingT;

    pic.appendChild(pic1);
    details.appendChild(mealn);
    details.appendChild(desc);
    details.appendChild(price);
    details.appendChild(name);
    details.appendChild(waitingTime);
    meal.appendChild(pic);
    meal.appendChild(details);
    document.querySelector("#meals").appendChild(meal);
}


