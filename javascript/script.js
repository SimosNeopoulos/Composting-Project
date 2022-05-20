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
            " numeric and special character \"@#$%^&*\"");
        signUpPassword.reportValidity();
    });

    document.getElementById("sign-up-form").addEventListener("submit", ev => {
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


/*********** LOG IN EVENT LISTENERS ***********/


document.getElementById("log-in-form").addEventListener("submit", ev => {
    let form = ev.target;
    let data = new FormData(form);
    ev.preventDefault();
});


/******************** ***********************/


/*********** CONTACT EVENT LISTENERS ***********/

document.getElementById("contact-form").addEventListener("submit", ev => {
    let form = ev.target;
    let data = new FormData(form);
    ev.preventDefault();
});

/******************** ***********************/

function nameVerification(username) {
    return /^[a-zA-Z][a-zA-Z0-9_]{4,16}$/.test(username);
}

function passwordVerification(password) {
    return /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/.test(password);
}