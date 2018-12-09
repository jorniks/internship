
<!DOCTYPE html>

<html>
    <head>

        <link href="assets/img/interns.jpg" rel="icon">

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Interns.Ng</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    </head>

    <body>
        <!-- nav bar -->
            <?
                include "core/full_header.php";
                include "backend/connection.php";
            ?>
        <!-- nav bar end-->

        <main>
            <div class="container-fluid">
                <?
                    if (!isset($_SESSION['username'])) {
                ?>
                        <div class="alert text-center">
                            <label>
                                You need to log in to perform this operation.
                            </label>
                            <h5>You will be redirected to the <a href="login.php">login page</a> in 5 seconds.</h5>
                        </div>
                <?
                        header("refresh:5; url=login.php");
                    } else {
                        $username = $_SESSION['username'];

                        //PARAMTERS FROM URL PASSED THROUGH $_GET
                        
                        //VISIBLE BUT NOT USED AND USEFUL
                        $organization = $_GET['organization'];
                        $category = $_GET['category'];
                        $description = $_GET['description'];


                        //NOT VISIBLE BUT USED AND VERY USEFUL
                        $get_username = $_GET['username'];
                        $postID = $_GET['postID'];


                    try {
                        $user_stmt = $con->prepare("SELECT * FROM `student` WHERE `username` = '$username'");
                        $user_stmt->execute();
                        if ($user_stmt->rowCount() > 0) {
                ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="centered">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center">
                                <h2 class="text-primary">New Application</h2>
                            </div>

                            <div class="panel-body">

                                <div class="tab-content">

                                    <div class="tab-pane fade active in" id="yourDetail">

                                        <div class="well well-lg">
                                            <h4>Organization: </h4><strong class="org"><?=$organization;?></strong>
                                            <h5>Category: <strong><?=$category;?></strong></h5>
                                            <h5>Description:</h5><strong><?=$description;?></strong>
                                        </div>

                                    <input type="hidden" id="postID" value="<?=$postID;?>">
                                    <input type="hidden" id="c_username" value="<?=$get_username;?>">

                                        <div class="message"></div>
                                        
                                        <div class="form-group">
                                            <input type="text" id="name" class="form-control" placeholder="Full Name">
                                            <small id="alert" class="name"></small>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender: </label>
                                            <select class="form-control" id="gender">
                                                <option></option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                            <small id="alert" class="gender"></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="email" class="form-control" placeholder="Email">
                                            <small id="alert" class="email"></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="phone" class="form-control" placeholder="Phone Number">
                                            <small id="alert" class="phone"></small>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="3" id="address" placeholder="Current Address"></textarea>
                                            <small id="alert" class="address"></small>
                                        </div>

                                        <!--==============================================================
                                                NEXT BUTTON TO SWITCH TAB FROM "YOUR DETAIL" TAB TO "EDUCATION DETAIL" TAB
                                        ===============================================================-->
                                        <div class="form-group pull-right">
                                            <button class="btn btn-success" data-toggle="tab" data-target="#educationDetail">Next</button>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="educationDetail">

                                        <div class="well well-lg">
                                            <h4>Organization: </h4><strong><?=$_GET['organization'];?></strong>
                                            <h5>Category: <strong><?=$_GET['category'];?></strong></h5>
                                            <h5>Description:</h5><strong><?=$_GET['description'];?></strong>
                                        </div>
                                        
                                        <div class="message2"></div>

                                        <div class="form-group">
                                            <input type="text" id="school" class="form-control" placeholder="Institution Name">
                                            <small id="alert" class="school"></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="duration" class="form-control" placeholder="Duration of study (2017/2019)">
                                            <small id="alert" class="duration"></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="department" class="form-control" placeholder="Department (Computer Science)">
                                            <small id="alert" class="department"></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="course" class="form-control" placeholder="Course of Study">
                                            <small id="alert" class="course"></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" id="postID" class="form-control" placeholder="Placement ID" value="<?=$_GET['id']?>">
                                        </div>

                                        <!--==============================================================
                                                NEXT BUTTON TO SWITCH TAB FROM "YOUR DETAIL" TAB TO "EDUCATION DETAIL" TAB
                                        ===============================================================-->
                                        <div class="form-group pull-left">
                                            <button class="btn btn-success previous" data-toggle="tab" data-target="#yourDetail">Previous</button>
                                        </div>

                                        <div class="form-group pull-right">
                                            <button class="btn btn-primary submit">Submit</button>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                                    
            </div>
                <?
                    } else {
                        $comp_stmt = $con->prepare("SELECT * FROM `comp_users` WHERE `username` = '$username'");
                        $comp_stmt->execute();
        
                        if ($comp_stmt->rowCount() > 0) {
                ?>
                    <div class="alert text-center">
                        <label class="text-danger">
                            ACCESS DENIED!
                        </label>
                        <h5>
                            You can not perform this operation because your account is a company account.
                        </h5>
                    </div>
                <?
                        } else {
                            ?>
                                <div class="alert text-center">
                                    <label class="text-danger">
                                        ACCESS DENIED!
                                    </label>
                                    <h5>
                                        You can not perform this operation because your account could not be verified.
                                    </h5>
                                </div>
                            <?
                        }
                    }
                    
                } catch (PDOException $th) {
                    echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
                }
                    }
                ?>
            </div>
        </main>
        
        <?include "core/footer.php";?>
        

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>


<script>
    $(document).ready(function () {
        setInterval(function() {clearError()}, 500);
        
        $(".submit").click(function () {
            submitTo();
        });
    });

    function submitTo() {
        var postID = $("#postID").val().trim();
        var c_username = $("#c_username").val().trim();
        
        var name = $("#name").val().trim();
        var gender = $("#gender").val().trim();
        var email = $("#email").val().trim();
        var phone = $("#phone").val().trim();
        var address = $("#address").val().trim();
        var school = $("#school").val().trim();
        var duration = $("#duration").val().trim();
        var department = $("#department").val().trim();
        var course = $("#course").val().trim();

        $(".message").html("");
        $(".message2").html("");

        if (!name) {
            emptiness("name", "name", "name");
            $(".previous").click();
        } else if (!gender) {
            emptiness("gender", "gender", "gender");
            $(".previous").click();
        } else if (!email) {
            emptiness("email", "email", "email");
            $(".previous").click();
        } else if (!phone) {
            emptiness("phone", "phone", "phone");
            $(".previous").click();
        } else if (!address) {
            emptiness("address", "address", "address");
            $(".previous").click();
        } else if (!school) {
            emptiness("school", "school", "school");
        } else if (!duration) {
            emptiness("duration", "duration", "duration");
        } else if (!department) {
            emptiness("department", "department", "department");
        } else if (!course) {
            emptiness("course", "course", "course");
        } else {
            if (email.indexOf("@") >= 0) {
                $.ajax({
                    type: "POST",
                    url: "backend/insert_to_db.php",
                    data: {
                        "postID": postID,
                        "c_username": c_username,
                        "name": name,
                        "gender": gender,
                        "email": email,
                        "phone": phone,
                        "address": address,
                        "school": school,
                        "duration": duration,
                        "department": department,
                        "course": course,
                    },

                    success: function (value) {
                        if (value == 1) {
                            successMessage("message", "<h4>Application submitted.</h4> You will receive an email with acceptance status.");
                            $(".previous").click();
                            clearFields();
                        } else if (value == 2) {
                            errorMessage("message2", "<h4>Application failed submitted.</h4> Please retry sending");
                        } else {
                            $(".message2").html("<div class='alert alert-danger'>" + value + "</div>");
                        }
                    }
                });
            } else {
                $(".email").html("Enter a valid email address.");
                $("#email").focus();
            }
        }
    }

    function clearFields() {
        $("#name").val("");
        $("#email").val("");
        $("#phone").val("");
        $("#address").val("");
        $("#school").val("");
        $("#duration").val("");
        $("#department").val("");
        $("#course").val("");
    }


	function clearError() {
		if ($("#name").val().trim()) {
			$(".name").html("");
		}
		if ($("#gender").val().trim()) {
			$(".gender").html("");
		}
		if ($("#email").val().trim()) {
			$(".email").html("");
		}
		if ($("#phone").val().trim()) {
			$(".phone").html("");
		}
		if ($("#address").val().trim()) {
			$(".address").html("");
		}
		if ($("#school").val().trim()) {
			$(".school").html("");
		}
		if ($("#duration").val().trim()) {
			$(".duration").html("");
		}
		if ($("#department").val().trim()) {
			$(".department").html("");
		}
		if ($("#course").val().trim()) {
			$(".course").html("");
		}
	}
</script>