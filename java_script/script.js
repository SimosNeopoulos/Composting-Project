/********* SCRIPT FOR STICKY NAVIGATION  *********/

let head = document.querySelector("header");

window.addEventListener("scroll", () => {
    if (document.documentElement.scrollTop > 20) {
        head.classList.add("sticky-header")
    } else {
        head.classList.remove("sticky-header")
    }
});

/******************         ********************/

/************ PHONE NAVIGATION **************/
function openNav() {
    document.getElementById("side-nav").style.width = "45%"
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
    let username = document.getElementById("log-in-username").value;
    let email = document.getElementById("log-in-email").value;
    let address = document.getElementById("log-in-address").value;
    let password = document.getElementById("log-in-password").value;
    let phone = document.getElementById("log-in-phone").value;
}

function signUpVerification() {
    /**
     * TODO: Write the function
     */
}

function contactClick() {
    let name = document.getElementById("contact-name").value;
    let email = document.getElementById("contact-email").value;
    let message = document.getElementById("contact-message").value;
    let subject = document.getElementById("contact-subject").value;
}

/*********************** ************************/