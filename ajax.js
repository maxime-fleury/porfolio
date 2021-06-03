function loadPage(page) {
	loadXMLDoc(page);
    desactivate(page);
	return false;
}

function loadXMLDoc(page) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
           if (xmlhttp.status == 200) {
               document.getElementById("page").innerHTML = xmlhttp.responseText;
           }
           else if (xmlhttp.status == 400) {
              alert('There was an error 400');
           }
           else {
               alert('something else other than 200 was returned');
           }
        }
    };

    xmlhttp.open("GET", page, true);
    xmlhttp.send();
}
function desactivate(page){
    //enlève la classe active lors d'un changement de page (car pas de rechargement du menu à gauche)
    
    var x = document.querySelector(".active");
    if(('index.php?id=1&amp;header=off' != page) && (x != undefined)){
        x.classList.remove('active');
        x.classList.add('not_active');
    }


}