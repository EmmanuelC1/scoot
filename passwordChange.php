<?php
session_start();
include 'loginFunctions.php'; 

if(isset($_POST['guestBtn'])){
    $_SESSION['loggedIn'] = "No";
    header('Location: home.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Scoot</title>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <header>
            <div class="top">
                <img src="images/scoot.png" id="logo" onclick="window.location.href='home.php'" style="cursor:pointer">
            </div>
            
        </header>
        <nav id="nav">
        <a style='margin-right:200px'href='profile.php'> My Profile </a>
        <a href='logout.php'> Logout </a>
        </nav>
        <div class="center">
            <h3>Change Password</h3>
            <form method="POST" class="login">
                <input type="password" name="password" id ="password" placeholder="Password"></input>
                <input type="password" name="newPassword" id="newPassword" placeholder="New Password"></input>
                <button type="button" id="submitBtn" value="change">Change</button>
            </form> 
        </div>
        
        <div class="error">
            
        </div>
       

    </body>
</html>

<script>
    $("#submitBtn").click(onButtonClicked);
    
    function onButtonClicked() {
            var jsonData = {
                "password" : $("#password").val(),
                "newPassword": $("#newPassword").val()
            };

            $.ajax({
                    // The URL for the request
                    url: "settingsFunctions.php",

                    // Whether this is a POST or GET request
                    type: "POST",

                    // The type of data we expect back
                    dataType: "json",

                    contentType: "application/json",

                    data: JSON.stringify(jsonData),
                    
            })
                    .done(function(data) {
                        if(data["data"] == "true"){
                            $(".error").empty();
                            $(".center").empty();
                            $(".center").html("<h2>Password Changed</h2>");
                        }
                        else{
                            $(".error").empty();
                            $(".error").append("<h2>" + data["data"] + "</h2>");
                        }
                        
                    })
                    
                    .always(function(data, status) {
                    });

            
        }
</script>