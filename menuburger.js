window.onload=everything;

function everything(){
const burger = document.getElementById("burger");
const menu = document.getElementById("menu");
const page = document.getElementById("page");
function toggleMenu() {
    if (menu.style.display === "none" && page.style.display === "block") {
        menu.style.display = "block";
        page.style.display = "none";
        console.log("show");
    } else {
        menu.style.display = "none";
        page.style.display = "block";
        console.log("hide");
    }
}
burger.addEventListener("click", toggleMenu);
var menuLinks = document.querySelectorAll(".menuLink")
menuLinks.forEach(
function (menuLink) {
    menuLink.addEventListener("click", toggleMenu)
});
menu.style.display = "none";
page.style.display = "block";
}

    
