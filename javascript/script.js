/********* SCRIPT FOR STICKY NAVIGATION  *********/
window.addEventListener("scroll", () => {
    if (document.documentElement.scrollTop > 20) {
        document.querySelector("header").classList.add("sticky-header")
    } else {
        document.querySelector("header").classList.remove("sticky-header")
    }
});

/******************         ********************/

/************ PHONE NAVIGATION **************/
function openNav() {
    document.getElementById("side-nav").style.width = "60%"
}

function closeNav() {
    document.getElementById("side-nav").style.width = "0%"
}

/********************  **********************/

/*********** BUTTON PRESSING EVENTS ***********/

function logInClick() {
    let email = document.getElementById("log-in-email").value;
    let password = document.getElementById("log-in-password").value;
}

function signUpClick() {
    let username = document.getElementById("sign-up-username").value;
    let email = document.getElementById("sign-up-email").value;
    let address = document.getElementById("sign-up-address").value;
    let password = document.getElementById("sign-up-password").value;
    let phone = document.getElementById("sign-up-tel").value;

    if (!nameVerification(username)) {
        alert("Your Username is not valid. Only alphabetic, numeric characters and '_' are acceptable.");
        document.getElementById("sign-up-username").focus();
        return;
    }

    if (!emailVerification(email)) {
        alert("Email already exists");
        document.getElementById("sign-up-email").focus();
        return;
    }

    if (!passwordVerification(password)) {
        alert("Password not valid");
        document.getElementById("sign-up-password").focus();
        return;
    }

    if (!phoneVerification(phone)) {
        alert("Phone not valid");
        document.getElementById("sign-up-tel").focus();
    }
}

function nameVerification(username) {
    let validUsername = /^[a-zA-Z0-9_]{4,16}$/.test(username);
    let exists = false; /** TODO: check if username already exists in the database */
    return validUsername && !exists;
}

function emailVerification(email) {
    let validEmail = true; /** TODO: check if email already exists in the database */
    return validEmail;
}

function passwordVerification(password) {
    return /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/.test(password);
}

function phoneVerification(phone) {
    let validPhone = true; /** TODO: check if email already exists in the database */
    return validPhone;
}

function contactClick() {
    let name = document.getElementById("contact-name").value;
    let email = document.getElementById("contact-email").value;
    let message = document.getElementById("contact-message").value;
    let subject = document.getElementById("contact-subject").value;
    /**
     * TODO: Complete the function
     */
}

/*********************** ************************/
