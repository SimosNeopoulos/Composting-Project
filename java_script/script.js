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
    let username = document.getElementById("log-in-username").value;
    let email = document.getElementById("log-in-email").value;
    let address = document.getElementById("log-in-address").value;
    let password = document.getElementById("log-in-password").value;
    let phone = document.getElementById("log-in-phone").value;
    /**
     * TODO: Complete the function
     */
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
    /**
     * TODO: Complete the function
     */
}

/*********************** ************************/

/***************** DROPDOWN MENU ***************/

/*
function dropdownMenu() {
    let btn_forum_filter = document.querySelector('.btn-forum-filter');
    let dropdown_menu = document.querySelector('.dropdown_menu');
    let container = document.querySelector('.container');
    btn_forum_filter.addEventListener("click",()=>{
        dropdown_menu.classList.toggle('open_dropdown_menu');
        container.classList.toggle('change_container_color');
    });
}
*/
