document.addEventListener("DOMContentLoaded", function() {
    var xhttp; 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("divprofiles").innerHTML =this.responseText ;
        }
    };  
    document.getElementById("divprofiles").innerHTML = "";
    xhttp.open("GET", "results.php", true);
    
   
    xhttp.send();

});
/*
function loadUsers(){
    var xhttp; 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("divprofiles").innerHTML =this.responseText ;
        }
    };  
    document.getElementById("divprofiles").innerHTML = "";
    xhttp.open("GET", "results.php", true);
    
   
    xhttp.send();
}
*/