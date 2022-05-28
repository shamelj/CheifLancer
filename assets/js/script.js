let cook ='abu zant';
let me='la7em 7alal';
let de='very good lahem yes very nice yyyeees yeeees';
let price ='55$';
let waitingT='16 days';
let arrImage =['https://img.freepik.com/free-photo/big-hamburger-with-double-beef-french-fries_252907-8.jpg?w=2000','https://images.everydayhealth.com/images/diet-nutrition/34da4c4e-82c3-47d7-953d-121945eada1e00-giveitup-unhealthyfood.jpg?sfvrsn=a31d8d32_0'];
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
    name.className="name";
    price.className="price";
    mealn.className="mealn";

    mealn.style.fontSize ="22";
    mealn.style.fontWeight="bold";
    price.style.fontSize="45"
    
    pic1.style.backgroundImage="url('"+arrImg[0]+"')";
    pic1.style.backgroundRepeat='no-repeat'
    if(arrImg[1]!=null){
     pic2.style.background="url('"+arrImg[1]+"')";
     pic2.style.backgroundRepeat='no-repeat';
     pic.appendChild(pic2);
    }
    name.textContent = "Cheif :" + cookName;
    price.textContent=mprice;
    mealn.textContent = mealname;
    desc.textContent  = description;
    waitingTime.textContent ="order is deliverd in less than"+ waitingT;

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
addMeal(cook,me,price,de,waitingT,arrImage);


