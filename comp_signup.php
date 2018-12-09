

<!DOCTYPE html>
<html lang="en">
<head>

    <link href="assets/img/interns.jpg" rel="icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Interns.Ng</title>
</head>
<body class="register">
    <!-- nav bar -->
        <? include "core/sign_up_header.php"?>
    <!-- nav bar end-->

    <main>
        
        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Company Sign up</h4>
                    </div>

                    <div class="panel-body">
                        <div class="message"></div>
                            <div class="form-group">
                                <label>Company Category:</label>
                                <select class="form-control" required id="category">
                                    <option></option>
                                    <option>Agriculture</option>
                                    <option>Media</option>
                                    <option>Banking</option>
                                    <option>Communication</option>
                                    <option>Construction</option>
                                    <option>Engineering</option>
                                    <option>Health</option>
                                    <option>Science</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Company Name" required id="name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" placeholder="Company Email" required id="email">
                                <small class="email-error"></small>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" placeholder="Office Address" required id="address"></textarea>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Login Username" required id="username">
                                <small class="user-error"></small>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Password" required id="password1">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Confirm Password" required id="password2">
                            </div>

                            <button class="btn btn-block btn-primary">Sign up</button>

                            <br>
                            Already have an account? <a href="login.php">Login instead</a>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>


<script>

/*================================================================================================
*
*   AJAX REQUEST TO SEND DATA FROM THE FORM TO THE DATABASE WITHOUT REFRESHING THE WEB PAGE
*
=================================================================================================*/
$(document).ready(function () {
    $("button").click(function (e) {
        e.preventDefault(); // PREVENTS THE BROWSER FROM SENDING THE DATA USING THE DEFAULT <form></form> BEHAVIOUR WHICH REFRESHES THE PAGE IN THE PROCESS

        //CAPTURE ALL VALUES ENTERED IN EACH TEXTBOX
        var category = $("#category").val().trim();
        var name = $("#name").val().trim();
        var email = $("#email").val().trim();
        var address = $("#address").val().trim();
        var username = $("#username").val().trim();
        var password1 = $("#password1").val().trim();
        var password2 = $("#password2").val().trim();
        
        // TEST EACH TEXTBOX TO MAKE SURE NO ONE IS LEFT EMPTY
        if (!category) {
            $(".message").html("Select your company category");
            $("#category").focus();
        } else if (!name) {
            emptiness("message", "name", "name");
        } else if (!email) {
            emptiness("message", "email", "email");
        } else if (!address) {
            emptiness("message", "address", "address");
        } else if (!username) {
            emptiness("message", "username", "username");
        } else if (!password1) {
            emptiness("message", "password1", "password");
        } else if (!password2) {
            emptiness("message", "password2", "confirm password");
        } else if (password1 != password2) { // TEST PASSWORDS TO MAKE SURE THE USER DID NOT MAKE A MISTAKE WHILE TYPING
            $(".message").html("Passwords don't match.");
            $("#password2").val("");
            $("#password2").focus();
        } else {
            if (email) {
                // TEST THE EMAIL TEXTBOX TO MAKE SURE A VALID EMAIL ADDRESS WAS ENTERED
                if (email.indexOf("@") >= 0) {
                    // SEND DATA TO PHP FOR SERVER PROCESSING USING $_POST METHOD
                    $.ajax({
                        type: "GET",
                        url: "backend/insert_to_db.php?category="+category+"&company="+name+"&email="+email+"&address="+address+"&username="+username+"&password="+password1,
                        data: {
                            "category": category,
                            "company": name,
                            "email": email,
                            "address": address,
                            "username": username,
                            "password": password1
                        },
                        // CAPTURE PHP RESPONSE FROM DATABASE EXECUTION AND POST APPROPRIATELY
                        success: function (message) {
                            if (message == 1) {
                                $(".message").html("<div class='alert alert-success'>Registered successfully.</div>");
                                clearInput();
                                setTimeout(function () {
                                    window.location = "login.php";
                                }, 2000);
                            } else if (message == 2) {
                                $(".user-error").html("Username is already taken.");
                            } else if (message == 3) {
                                $(".email-error").html("Email is already registered.");
                            } else {
                                $(".message").html(message);
                            }
                        }
                    });
                } else {
                    $(".message").html("Enter a valid email address.");
                    $("#email").focus();
                }
            }
        }
        
    });
});


function clearInput() {
    $("#name").val("");
    $("#email").val("");
    $("#username").val("");
    $("#password1").val("");
    $("#password2").val("");
    $("#address").val("");
    $(".user-error").html("");
    $(".email-error").html("");
}
</script>