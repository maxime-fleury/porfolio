let div = document.createElement("div");
div.style.display = none;
let priv = document.getElementById("privacy");

priv.addEventListener("click", showMessage(div, "Politique de confidentialité <br> Nous ne stockons/partageons aucune données personnelle."));

function showMessage(el, message){
    el.innerHTML(message);
    el.style.display = block;
    el.style.color = green;
    el.style.background = white;
    setTimeout(function (){
        el.style.display = none;
    },1000);

}