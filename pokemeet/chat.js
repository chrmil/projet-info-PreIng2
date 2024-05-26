document.addEventListener("DOMContentLoaded",  function(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href=this.response;
        }
        
    }
    xhttp.open("GET", "chatlink.php", true);
    xhttp.send();
 
    } );
