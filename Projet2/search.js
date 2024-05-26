function loadUserDetails(j) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var userDetails = JSON.parse(this.responseText); //  JSON data
            var len=userDetails.length;
            
            for (var i = 0; i < 9; i++) {
              
                var userNameElement = document.getElementById("user-" + (i + 1) + "-nom");
                var userAgeElement = document.getElementById("user-" + (i + 1) + "-age");
                var userSexElement = document.getElementById("user-" + (i + 1) + "-sex");
                var userTypeElement = document.getElementById("user-" + (i + 1) + "-type");

                if (userNameElement) {
                    userNameElement.textContent = userDetails[j].nom || "empty";
                }
                if (userAgeElement) {
                    userAgeElement.textContent = userDetails[j].age || "empty";
                }
                if (userSexElement) {
                    userSexElement.textContent = userDetails[j].sex || "empty";
                }
                if (userTypeElement) {
                    userTypeElement.textContent = userDetails[j].type || "empty";
                }
                j++;
                   
            }
            var n = 0;
            for (var i = 0; i <9; i++) {
                var card = document.getElementById("card-" + (i + 1));
                var userNameElement = document.getElementById("user-" + (i + 1) + "-nom");
                var userAgeElement = document.getElementById("user-" + (i + 1) + "-age");
                var userSexElement = document.getElementById("user-" + (i + 1) + "-sex");
                var userTypeElement = document.getElementById("user-" + (i + 1) + "-type");

                if ( userNameElement.textContent == "empty") {
                    card.style.visibility = "hidden";
                    n++;
                }
            }
            if(n==9){
                document.getElementById("div1").innerHTML = "There is no trainer fitting those filters.<br>" ;
            }
        }
        
    };
    xhttp.open("GET", "results.php", true);
    xhttp.send();
}

function next(j){
    loadUserDetails(j);
}
function previous(j){
    loadUserDetails(j-9);
}

document.addEventListener("DOMContentLoaded", function() {
    loadUserDetails(0);
});
