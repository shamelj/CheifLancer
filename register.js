const isCustomer = document.getElementById('customer');
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

function validateLogin() {
    if (usernameEl.value.length < 2)
        return 'Invalid Username!';
    else if (firstNameEl.value.length < 2)
        return 'Invalid First Name!';
    else if (lastNameEl.value.length < 2)
        return 'Invalid Last Name!';
    else if (emailEl.value.length < 6)
        return 'Invalid Email';
    else if (!isCustomer.value && locationEl.value.length < 6)
        return 'Invalid Location';
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
async function submitForm() {
    const isValid = validateLogin();
    console.log(isValid)
    if (isValid != null) {
        loginErrorEl.innerHTML = `
        <div class="alert alert-danger" role="alert">
        ${isValid}
        </div>
        `;
        return;
    }
    const account = {
        username: usernameEl.value,
        firstName: firstNameEl.value,
        lastName: lastNameEl.value,
        email: emailEl.value,
        password: passwordEl.value,
        type: isCustomer.checked ? 'customer' : 'cook',
        picture: pictureEl.value
    }
    if (!isCustomer.checked)
        account.location = locationEl.value;

    const response = await fetch('/register', {
        method: 'POST',

        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(account)

    });
    const status = await response.status;
    const message = await response.text();
    console.log(status)
    if (status === 200) {
        console.log(message)
        loginErrorEl.innerHTML = `
        <div class="alert alert-success" role="alert">
                ${message} You'll get directed to login page in 3 seconds.
              </div>
        `;
        setTimeout(() => window.location.href = "/login.html", 3000);
        window.location.href = "/index.html"
    } else {
        loginErrorEl.innerHTML = `
        <div class="alert alert-danger" role="alert">
        ${message}
        </div>
        `;
    }
}