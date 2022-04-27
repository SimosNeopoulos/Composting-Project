/********* SCRIPT FOR STICKY NAVIGATION  *********/
let head = document.querySelector("header");

window.addEventListener("scroll", () => {
    if (document.documentElement.scrollTop > 20) {
        head.classList.add("sticky-header")
    } else {
        head.classList.remove("sticky-header")
    }
});
/*********************** ************************/