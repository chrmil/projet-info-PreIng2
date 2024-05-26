function loadUserDetails() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var userDetails = JSON.parse(this.responseText); //  JSON data
            
            for (var i = 0; i < userDetails.length; i++) {
                
                var userNameElement = document.getElementById("user-" + (i + 1) + "-nom");
                var userAgeElement = document.getElementById("user-" + (i + 1) + "-age");
                var userSexElement = document.getElementById("user-" + (i + 1) + "-sex");
                var userTypeElement = document.getElementById("user-" + (i + 1) + "-type");

                if (userNameElement) {
                    userNameElement.textContent = userDetails[i].nom || "No name available";
                }
                if (userAgeElement) {
                    userAgeElement.textContent = userDetails[i].age || "No age available";
                }
                if (userSexElement) {
                    userSexElement.textContent = userDetails[i].sex || "No gender available";
                }
                if (userTypeElement) {
                    userTypeElement.textContent = userDetails[i].type || "No type available";
                }
            }
            var n=0;
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
            
            if(n==9){  //if no user found
                document.getElementById("div1").innerHTML="There are no trainers fulfilling these parameters.<br>";
            }
            if(n==0){
                
                
            }
        }
    };
    xhttp.open("GET", "results.php", true);
    xhttp.send();
}

function next(p){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var userDetails = JSON.parse(this.responseText); //  JSON data
            var j=p*9;
            for (var i = 0; j < userDetails.length; i++) {
                
                var userNameElement = document.getElementById("user-" + (i + 1) + "-nom");
                var userAgeElement = document.getElementById("user-" + (i + 1) + "-age");
                var userSexElement = document.getElementById("user-" + (i + 1) + "-sex");
                var userTypeElement = document.getElementById("user-" + (i + 1) + "-type");

                if (userNameElement) {
                    userNameElement.textContent = userDetails[j].nom || "No name available";
                }
                if (userAgeElement) {
                    userAgeElement.textContent = userDetails[j].age || "No age available";
                }
                if (userSexElement) {
                    userSexElement.textContent = userDetails[j].sex || "No gender available";
                }
                if (userTypeElement) {
                    userTypeElement.textContent = userDetails[j].type || "No type available";
                }
                j++;
            }
            var n=0;
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
            if(n==9){  //if no user displayed
                document.getElementById("div1").innerHTML="There are no trainers fulfilling these parameters.<br>";
            }
        }
    };
    xhttp.open("GET", "results.php", true);
    xhttp.send();
}



document.addEventListener("DOMContentLoaded", function() {
    loadUserDetails();
    var next_button =  document.getElementById("next");
    var reset_button =  document.getElementById("reset");
    var count = 0; 
    function counter() {
        count += 1;
    }
    next_button.addEventListener("click", function(){
        counter();
        next(count);
    } );
    reset_button.addEventListener("click",  function(){
        count=0;
        loadUserDetails();
    } );
});




