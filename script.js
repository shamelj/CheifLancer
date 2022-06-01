async function login() {
    //get the info from the page and prepare the massege to the API
    const acc = {
        username: document.getElementById("username").value,
        password: document.getElementById("password").value
    };
    //console.log(acc);
    
    const massage = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(acc)
    };
    //send the massage and get the response
    let response = await fetch("/CheifLancer/API/login.php", massage);
    let data = await response.json();
    if(data.state === 'ACCEPTED'){
        let user=data.body;
        setCookie("user", JSON.stringify(user), 1);
        
        if(user.type ==="Customer" ){
            window.location = "/CheifLancer/custScreen/";
        }else{
            //waiting for cook homepage development
        }
    }else if(data.state === "NO_MATCH"){
        alert("User not found, check username and password again please.");
    }

}


function setCookie(cName, cValue, exHours) {
    const d = new Date();
    d.setTime(d.getTime() + (exHours*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cName + "=" + cValue + ";" + expires + ";path=/";
}