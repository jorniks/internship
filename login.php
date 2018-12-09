

<!DOCTYPE html>
<html lang="en">
    <head>

            <link href="assets/img/interns.jpg" rel="icon">

            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Interns.Ng</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="assets/css/bootstrap.css">
            <link rel="stylesheet" href="assets/css/font-awesome.css">
            <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />

            <script type="text/javascript" language="javascript">
                function showPassword() {
                    var passText = document.getElementById('password');
                    var checkbox = document.getElementById('checkbox');

                    if (passText.type == "password") {
                        passText.type = "text";
                    } else {
                        passText.type = "password";
                    }
                }
            </script>
    </head>
    <body class="login">
        <!-- nav bar -->
            <?
                include "core/sign_up_header.php";

                session_start();

                if (isset($_SESSION['username'])) {
                    header("location: index.php");
                }
            ?>
        <!-- nav bar end-->

        <main>
            
            <div class="container">
                <div class="row">
                    <div class="panel-default">
                        <div class="login-panel">
                            <p class="login-img text-center"><i class="fa fa-lock"></i></p>

                                <div class="message"></div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="username" class="form-control" placeholder="Username" required autofocus>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input class="form-control" type="password" id="password" placeholder="Password" required>
                                </div>
                                <div class="checkbox check">
                                    <input type="checkbox" id="checkbox" onchange="showPassword()"> Show Password
                                </div>
                                <button class="btn btn-info btn-block">Login</button>

                                Don't have an account?
                                <div><a href="comp_signup.php">Register as a company</a></div> <label>OR</label>
                                <div><a href="sign_up.php">Register as a student</a></div>
                            
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
        // RUN clearMessage() FUNCTION EVERY 1 SECOND TO CLEAR MESSAGE DISPLAYED ON .message <div></div> IF THE ERROR IS ADDRESSED
        setInterval(function() {clearMessage()}, 1000);

        $("button").click(function () {
            login();
        });

        $(window).keyup(function (e) {
            if (e.keyCode == 13) {
                login();
            }
        });
    });


	function login() {
        //CAPTURE ALL VALUES ENTERED IN EACH TEXTBOX
		var username = $("#username").val().trim();
		var password = $("#password").val().trim();

        // TEST EACH TEXTBOX TO MAKE SURE NO ONE IS LEFT EMPTY
		if (!username) {
			$(".message").html("Please fill in the username field.");
			$("#username").focus();
		} else if (!password) {
			$(".message").html("Please fill in the password field.");
			$("#password").focus();
		} else {
            // SEND DATA TO SERVER VALIDATION USING $_POST METHOD
			$.ajax({
				url: "backend/select_from_db.php",
				type: "POST",
				async: false,
				data: {
					"username": username,
					"password": password,
				},
                // CAPTURE PHP RESPONSE FROM DATABASE EXECUTION AND POST APPROPRIATELY
				success: function (response) {
					if (response == 1) {
						$(".message").html("<div>Incorrect Username.</div>");
                        $("#username").focus();
                        $("#password").val("");
					} else if (response == 2) {
						$(".message").html("<div>Incorrect Password.</div>");
						$("#password").val("");
                        $("#password").focus();
					} else if (response == 3) {
						window.location = "index.php";
					} else if (response == 4) {
						window.location = "profile/admin_dashboard.php";
					} else {
						$(".message").html(response);
					}
						
				}
			});
		}
	}



    // FUNCTION TO CLEAR ERROR MESSAGE FROM MESSAGE <div></div>
	function clearMessage() {
		if ($(".message").html() == "Please fill in the username field." 
			|| $(".message").html() == "Please fill in your username or email and click the link again.") {
			if ($("#username").val().trim()) {
				$(".message").html("");
			}
		}
		if ($(".message").html() == "Please fill in the password field.") {
			if ($("#password").val().trim()) {
				$(".message").html("");
			}
		}
	}

</script>