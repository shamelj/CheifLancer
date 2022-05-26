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
    let response = await fetch("./test.php", massage);
    let data = await response.json();
    console.log(data);
    /*
    if (data.state === 'ACCEPTED') {      //if accepted save user data to 'account' in storage
        let body = data.body;
        let account = {username: body.username,
                       password: body.password,
                       profilePicSRC: body.profilePicSRC};
        localStorage.setItem('account', JSON.stringify(account));
        window.location.pathname = "/HeadManual/frontend/main/main.html";
    } else {
        alert("User not found, check username and password again please.");
    }
    */
}
