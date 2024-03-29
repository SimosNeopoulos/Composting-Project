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

/********** SIGN UP EVENT LISTENERS ***********/

    
    
    /** USERNAME **/
    let signUpUsername = document.getElementById("sign-up-username");
    signUpUsername.addEventListener("input", () => {
        if (nameVerification(signUpUsername.value)) {
            signUpUsername.setCustomValidity("");
            return;
        }
        signUpUsername.setCustomValidity("Username must be between 4 to 16 characters start with a letter" +
            " and to only contain alphabetic, numeric characters and '_'");
        signUpUsername.reportValidity();
    });
    
    
    let signUpPassword = document.getElementById("sign-up-password");
    signUpPassword.addEventListener("input", () => {
        if (passwordVerification(signUpPassword.value)) {
            signUpPassword.setCustomValidity("");
            return;
        }
        signUpPassword.setCustomValidity("Password must be 6-16 characters long and contain at least one" +
            " numeric and special character \"@!#$%^&*\"");
        signUpPassword.reportValidity();
    });

    let signUpForm = document.getElementById("sign-up-form");
    signUpForm.addEventListener('submit', ev => {
        let email = document.getElementById("sign-up-email").value;
        let address = document.getElementById("sign-up-address").value;
        let phone = document.getElementById("sign-up-tel").value;

        if (!nameVerification(signUpUsername.value)) {
            signUpUsername.setCustomValidity("");
            signUpUsername.setCustomValidity("Username must be between 4 to 16 characters start with a letter" +
            " and to only contain alphabetic, numeric characters and '_'");
            signUpUsername.reportValidity();
            ev.preventDefault();
            return;
        }

        if (!passwordVerification(signUpPassword.value)) {
            signUpUsername.setCustomValidity("Username must be between 4 to 16 characters start with a letter" +
            " and to only contain alphabetic, numeric characters and '_'");
            signUpUsername.reportValidity();
            ev.preventDefault();
            return;
        }
        
    });


function nameVerification(username) {
    return /^[a-zA-Z][a-zA-Z0-9_]{4,16}$/.test(username);
}

function passwordVerification(password) {
    return /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/.test(password);
}

/**************** PASSWORD VISIBILITY ****************/

var state = false
function toggleLogin() {
    if(state) {
        document.getElementById("log-in-password").setAttribute("type", "password");
        state = false;
    } else {
        document.getElementById("log-in-password").setAttribute("type", "text");
        state = true;
    }
}

var state2 = false
function toggleSignup() {
    if(state2) {
        document.getElementById("sign-up-password").setAttribute("type", "password");
        state2 = false;
    } else {
        document.getElementById("sign-up-password").setAttribute("type", "text");
        state2 = true;
    }
}
