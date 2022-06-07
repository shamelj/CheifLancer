//const isCustomer = document.getElementById('customer');
const usernameEl = document.getElementById('username');
const firstNameEl = document.getElementById('firstName');
const lastNameEl = document.getElementById('lastName');
const pictureEl = document.getElementById('picture');
const emailEl = document.getElementById('email');
const locationEl = document.getElementById('location');
const passwordEl = document.getElementById('password');
const confirmPasswordEl = document.getElementById('confirmPassword');
const phoneEl = document.getElementById('phone');
const submitBtn = document.getElementById('submit');
const loginErrorEl = document.getElementById('error');
const formEl = document.getElementById('registerForm');
const picturePreviewEl = document.getElementById('picturePreview');


let userInfo;
window.onload = ()=>{
    userInfo = JSON.parse(localStorage.getItem('userInfo'));
    console.log(userInfo);
    usernameEl.value = userInfo.username;
    firstNameEl.value = userInfo.firstName;
    lastNameEl.value = userInfo.lastName;
    emailEl.value = userInfo.email;
    passwordEl.value = userInfo.password;
    confirmPasswordEl.value = userInfo.password;
    phoneEl.value = userInfo.phoneNumber;
    picturePreviewEl.src = `/cheiflancer/database/profile_pictures/${userInfo.profileImage}`;
    picturePreviewEl.style.width= '150px';
    picturePreviewEl.style.height= '150px';



}

formEl.addEventListener('submit', async (e) => {
    e.preventDefault();
    const isValid = validateLogin();
    console.log(isValid);
    if (isValid != null) {
        loginErrorEl.innerHTML = `
        <div class="alert alert-danger" role="alert">
        ${isValid}
        </div>
        `;
        return;
    }
    const fData = new FormData(formEl);
    fData.append('picture',userInfo.profileImage);
    const response = await fetch('/cheiflancer/API/update_user.php', {
        method: 'POST',
        body: fData

    });
    let data = await response.json();
    console.log(data)
    if (data.status == 200) {
        loginErrorEl.innerHTML = `
        <div class="alert alert-success" role="alert">
                Account updated succesfully! You'll get directed to dashboard in 3 seconds.
              </div>
        `;
        setTimeout(() => window.location.href = "./index.html", 3000);
    } else {
        loginErrorEl.innerHTML = `
        <div class="alert alert-danger" role="alert">
        ${data.body}
        </div>
        `;
    }

})

function validateLogin() {
    if (usernameEl.value.length < 2)
        return 'Invalid Username!';
    else if (firstNameEl.value.length < 2)
        return 'Invalid First Name!';
    else if (lastNameEl.value.length < 2)
        return 'Invalid Last Name!';
    else if (emailEl.value.length < 6)
        return 'Invalid Email';
    else if (passwordEl.value.length < 6)
        return 'Invalid PassWord!'
    else if (passwordEl.value != confirmPasswordEl.value)
        return `Passwords didn’t match. Try again.`
    else if (phoneEl.value.length < 10)
        return `Invalid phone number.`
    else return null;
}

function hideLocation() {
    document.getElementById('locationBlock').style.display = 'none';

}

function showLocation() {
    document.getElementById('locationBlock').style.display = 'block'
}
