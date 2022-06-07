async function login() {
    //get the info from the page and prepare the massege to the API
    const acc = {
        username: document.getElementById("username").value,
        password: document.getElementById("password").value
    };

    const massage = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(acc)
    };
    //send the massage and get the response
    let response = await fetch("/CheifLancer/API/admin_login.php", massage);
    let data = await response.json();
    console.log(data);
    if (data.state === 'ACCEPTED') {
        window.location.href = "dashboard.html"
    } else if (data.state === "NO_MATCH") {
        alert("Admin not found, check username and password again please.");
    }

}

function setCookie(cName, cValue, exHours) {
    const d = new Date();
    d.setTime(d.getTime() + (exHours * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cName + "=" + cValue + ";" + expires + ";path=/";
}