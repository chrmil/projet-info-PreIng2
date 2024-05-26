function loadUserDetails() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var userDetails = JSON.parse(this.responseText); //  JSON data
            
            for (var i = 0; i < userDetails.length; i++) {

                var card = document.getElementById("card-" + (i + 1));
                var userNameElement = document.getElementById("user-" + (i + 1) + "-nom");
                var userAgeElement = document.getElementById("user-" + (i + 1) + "-age");
                var userSexElement = document.getElementById("user-" + (i + 1) + "-sex");
                var userTypeElement = document.getElementById("user-" + (i + 1) + "-type");
                var userImage = document.getElementById("image-" + (i + 1));
                
                if(userDetails[i].color!="empty" && card){
                    card.setAttribute("class", "grid-individual-card card-background-"+userDetails[i].color);
                }
                if(userDetails[i].starter!="empty" && userImage){
                    userImage.setAttribute("src", "https://heatherketten.files.wordpress.com/2018/03/"+userDetails[i].starter+".png");
                }
                else if(userImage){
                    userImage.setAttribute("src", "https://heatherketten.files.wordpress.com/2018/03/pikachu.png");
                }
             
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
            for (var i = 0; i <30; i++) {
                
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
            
            if(n==30){  //if no user found
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
            var j=p*30;
            var i=0;
            if(j<userDetails.length){
                for (var j = j; j < userDetails.length; j++) {
                    
                    var card = document.getElementById("card-" + (i + 1));
                    var userNameElement = document.getElementById("user-" + (i + 1) + "-nom");
                    var userAgeElement = document.getElementById("user-" + (i + 1) + "-age");
                    var userSexElement = document.getElementById("user-" + (i + 1) + "-sex");
                    var userTypeElement = document.getElementById("user-" + (i + 1) + "-type");
                    var userImage = document.getElementById("image-" + (i + 1));
                    if(userDetails[j].color!="empty"&& card){
                        card.setAttribute("class", "grid-individual-card card-background-"+userDetails[j].color);
                    }
                    if(userDetails[j].starter!="empty"&& userImage){
                        userImage.setAttribute("src", "https://heatherketten.files.wordpress.com/2018/03/"+userDetails[j].starter+".png");
                    }
                    else if(userImage){
                        userImage.setAttribute("src", "https://heatherketten.files.wordpress.com/2018/03/pikachu.png");
                    }
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
                    i++;
                }
                var k=i+1;
                for (var i = k; i < 30; i++) {
                    var card = document.getElementById("card-" + (i + 1));
                    var userNameElement = document.getElementById("user-" + (i + 1) + "-nom");
                    var userAgeElement = document.getElementById("user-" + (i + 1) + "-age");
                    var userSexElement = document.getElementById("user-" + (i + 1) + "-sex");
                    var userTypeElement = document.getElementById("user-" + (i + 1) + "-type");
                    var userImage = document.getElementById("image-" + (i + 1));
                   
                    if (userNameElement) {
                        userNameElement.textContent = "empty";
                    }
            
                }
                var n=0;
                for (var i = 0; i <30; i++) {
                    
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
            else{
                document.getElementById("div1").innerHTML="There are no more trainers fulfilling these parameters.<br>";
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
    next_button.addEventListener("click", function(){
        document.getElementById("div1").innerHTML="";
        count += 1;
        next(count);
    } );
    reset_button.addEventListener("click",  function(){
        document.getElementById("div1").innerHTML="";
        window.location.href=window.location.href;
    } );
});




