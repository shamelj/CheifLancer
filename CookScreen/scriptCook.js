const cook ='abu zant';
const me='la7em 7alal';
const de='very good lahem yes very nice yyyeees yeeees';
const price ='55$';
const waitingT='16 days';
const arrImage =['https://img.freepik.com/free-photo/big-hamburger-with-double-beef-french-fries_252907-8.jpg?w=2000','https://images.everydayhealth.com/images/diet-nutrition/34da4c4e-82c3-47d7-953d-121945eada1e00-giveitup-unhealthyfood.jpg?sfvrsn=a31d8d32_0'];
addMeal = (cookName,mealname,mprice,description,waitingT,arrImg) => {
    const meal = document.createElement("div");
    const pic = document.createElement("div");
    const pic1 = document.createElement("div");
    const pic2 = document.createElement("div");
    const details = document.createElement("div");
    const iconandprice = document.createElement("div");
    const name = document.createElement("p");
    const price = document.createElement("p");
    const mealn = document.createElement("p");
    const desc = document.createElement("p");
    const waitingTime = document.createElement("p");
    const trashIcon = document.createElement("button");
    trashIcon.className = "fas fa-trash";
    trashIcon.style.color = "darkgray";
    details.className="details";
    meal.className = "meal";
    pic.className="pic";
    pic1.className="pic1";
    pic2.className="pic2";
    name.className="name";
    price.className="price";
    mealn.className="mealn";
    iconandprice.className="iconprice";
    mealn.style.fontSize ="22";
    mealn.style.fontWeight="bold";
    price.style.fontSize="45"
    
    pic1.style.backgroundImage="url('/CheifLancer/Database/Profile_Pictures/"+arrImg[0]+"')";
    pic1.style.backgroundRepeat='no-repeat'
    if(arrImg[1]!=null){
     pic2.style.background="url('/CheifLancer/Database/Profile_Pictures/"+arrImg[1]+"')";
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
    iconandprice.appendChild(price);
    iconandprice.append(trashIcon);
    details.append(iconandprice);
    details.appendChild(name);
    details.appendChild(waitingTime);
    meal.appendChild(pic);
    meal.appendChild(details);
    trashIcon.addEventListener("click", () => deleteMeal(meal));
    document.querySelector("#meals").appendChild(meal);
}



async function showMeals(){
    
  const massage = {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({})
  };
  //send the massage and get the response
  let response = await fetch("/CheifLancer/API/get_cook_meals.php", massage);
  let data = await response.json();
  let meals = data.body;

  for(const  meal of meals){
      //check attributes' names
      addMeal(meal.cookUsername, meal.name, meal.price, meal.description, meal.waitingTime, meal.pictures);
  }

}

function deleteMeal(meal){
  meal.style.display='none';
}
window.onload=function(){

  
  let user=JSON.parse(document.cookie.split('=')[1]);
  console.log(user);
  document.getElementById('profile_img').src = `/cheiflancer/database/profile_pictures/${user.profileImage}`;

  showMeals();

}
