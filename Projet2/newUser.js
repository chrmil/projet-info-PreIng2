function checkUsername(q) {
       
    var xhttp; 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("div1").innerHTML =this.responseText ;
        }
    };  
    var userInfo = document.forms.userInfo;
    var formData = new FormData(userInfo);
    username=formData.get("username");
    if (username.length == 0 ) {
        document.getElementById("div1").innerHTML = "Please enter an username.";
        
    }
    else if (username.length<3){
        document.getElementById("div1").innerHTML = "This username is too short. The minimum length is 3 characters.";
    }
    else{
        document.getElementById("div1").innerHTML = "";
        xhttp.open("GET", "newUserCheck.php?q="+q, true);
    }
    xhttp.send();
}


function checkEmail(r) { 

       
    var xhttp; 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("div2").innerHTML =this.responseText ;
        }
    };  
    var userInfo = document.forms.userInfo;
    var formData = new FormData(userInfo);
    email=formData.get("email");
    if (email.length < 4 ) {
        document.getElementById("div2").innerHTML = "Please enter an email adress.";
    }
    else{
        document.getElementById("div2").innerHTML = "";
        xhttp.open("GET", "newUserCheck.php?r="+r, true);

    }
    xhttp.send();
}

function checkPassword() {
       
        var xhttp; 
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("div3").innerHTML =this.responseText ;
            }
        };  
        var userInfo = document.forms.userInfo;
        var formData = new FormData(userInfo);
        password1=formData.get("password1");
        password2=formData.get("password2");
        if (password1.length == 0 ) {
            document.getElementById("div3").innerHTML = "Please enter a password.";
           
        }
        else if (password1.length<5){
            document.getElementById("div3").innerHTML = "This password is too short. The minimum length is 5 characters.";
        }
        else if (password2.length == 0 ) {
            document.getElementById("div3").innerHTML = "Please confirm your password by entering it again";
          
        }
        else if(password1.length>password2.length){
            document.getElementById("div3").innerHTML = "";
        }
        else if (password1.length <= password2.length && password1!=password2){
            document.getElementById("div3").innerHTML = "Invalid password. Please try again.";
        }
    
        xhttp.send();
}
