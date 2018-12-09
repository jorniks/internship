
<!DOCTYPE html>

<html>
    <head>
        <? include "../profile_core/profile_link.php"; ?>

            <script type="text/javascript" language="javascript">
                function showPassword() {
                    var passText = document.getElementById('password');

                    if (passText.type == "password") {
                        passText.type = "text";
                    } else {
                        passText.type = "password";
                    }
                }

                function showPassword2() {
                    var passText = document.getElementById('password2');

                    if (passText.type == "password") {
                        passText.type = "text";
                    } else {
                        passText.type = "password";
                    }
                }
            </script>
    </head>

    <body>
        <!-- nav bar -->
            <?
                include "../profile_core/profile_header.php";
                $username = $_SESSION['username'];
            ?>
        <!-- nav bar end-->

        <main class="main">

            <div class="container-fluid">

                <ul class="breadcrumb">
                    <li>You are logged in as <label class="text-capitalize"><?=$username;?></label></li>
                </ul>

        <?
            $success = false;
            $failed = false;
    
            try {
                $user_stmt = $con->prepare("SELECT * FROM `student` WHERE `username` = '$username'");
                $user_stmt->execute();
                if ($row = $user_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $name = $row['name'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $address = $row['address'];
                    $school = $row['school'];
                    $duration = $row['duration'];
                    $department = $row['department'];
                    $course = $row['course'];
                    $gender = $row['gender'];
                    $password = $row['password'];
                } 
                
            } catch (PDOException $th) {
                echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
            }

            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $gender = $_POST['gender'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $school = $_POST['school'];
                $duration = $_POST['duration'];
                $department = $_POST['department'];
                $course = $_POST['course'];
                
                try {
                    $update_stmt = $con->prepare("UPDATE `student` SET `name`=?,`email`=?,`gender`=?,`phone`=?,`address`=?,`school`=?,`department`=?,`course`=?,`duration`=? WHERE `username` = '$username'");
                    $executed = $update_stmt->execute(array($name, $email, $gender, $phone, $address, $school, $department, $course, $duration));
                    
                    if ($executed) {
                        $success = true;
                    } else {
                        $failed = true;
                    }
                    
                } catch (PDOException $th) {
                    echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
                }
            } elseif (isset($_POST['change'])) {
                $old_password = trim(sha1($_POST['old_password']));
                $new_password = trim(sha1($_POST['new_password']));

                if ($password == $old_password) {
                    try {
                        $password_stmt = $con->prepare("UPDATE `student` SET `password`=? WHERE `username` = '$username'");
                        $executed = $password_stmt->execute(array($new_password));
                        
                        if ($executed) {
                            echo("<script>alert('Password successfully changed.');</script>");
                        } else {
                            echo("<script>alert('Password failed to change.');</script>");
                        }
                        
                    } catch (PDOException $th) {
                        echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
                    }
                } else {
                    echo("<script>alert('You entered a wrong password. Try again.');</script>");
                }
            } elseif (isset($_POST['delete'])) {
                $del_password = trim(sha1($_POST['del_password']));
                
                if ($password == $del_password) {
                    try {
                        $delete_stmt = $con->prepare("DELETE FROM `student` WHERE `username` = '$username'");
                        $executed = $delete_stmt->execute();
                        
                        if ($executed) {
                            echo("<script>alert('Your account was succefully deleted.');</script>");
                            session_destroy();
                        } else {
                            echo("<script>alert('Account was not deleted.');</script>");
                        }
                        
                    } catch (PDOException $th) {
                        echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
                    }
                } else {
                    echo("<script>alert('You entered a wrong password.');</script>");
                }
            }
        ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="centered">
                            <div class="panel panel-default">

                                <div class="panel-body">
                                    <form method="POST" action="profile.php" role="form" class="form">
                                        <div class="well well-sm">
                                            <h4 class="text-center">Personal</h4>
                                        </div>

                                <?
                                    if ($success == true) {
                                        echo ("<div class='alert alert-success'>Profile updated successfully.</div>");
                                    } else if($failed == true) {
                                        echo ("<div class='alert alert-danger'>Profile update failed, try again.</div>");
                                    }
                                    
                                ?>

                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="<?=$name;?>" value="<?=$name;?>" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            Gender:
                                            <select class="form-control" name="gender" required>
                                                <?
                                                    if ($gender == "Male") {
                                                ?>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                <?
                                                    } elseif ($gender == "Female") {
                                                ?>
                                                        <option>Female</option>
                                                        <option>Male</option>
                                                <?
                                                    } else {
                                                ?>
                                                        <option></option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                <?
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="<?=$email;?>" value="<?=$email;?>" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?=$phone;?>">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Address" rows="3" name="address"><?=$address;?></textarea>
                                        </div>

                                        <div class="well well-sm">
                                            <h4 class="text-center">Education</h4>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="School" value="<?=$school?>" name="school">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="duration" class="form-control" placeholder="Duration of study (2017/2019)" value="<?=$duration;?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="department" class="form-control" placeholder="Department" value="<?=$department;?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="course" class="form-control" placeholder="Course of Study" value="<?=$course;?>">
                                        </div>

                                        <button class="btn btn-block btn-primary" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>

                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h4 class="text-center">Danger zone</h4>
                                </div>
                                <div class="panel-body">
                                    <form method="POST" action="profile.php" role="form" class="form">
                                        <div class="well well-sm">
                                            <h4 class="text-center">Change Password</h4>
                                        </div>

                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="New Password" name="new_password" id="password" required>
                                            <span class="form-group input-group-btn">
                                            <label class="btn btn-default btn1" onclick="showPassword()"><i class="fa fa-eye" id="eye1"></i></label>
                                            </span>
                                        </div><small>Extremely case sensitive.</small>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Old password" name="old_password" id="password2" required>
                                            <span class="form-group input-group-btn">
                                            <label class="btn btn-default btn2" onclick="showPassword2()"><i class="fa fa-eye" id="eye2"></i></label>
                                            </span>
                                        </div>
                                        <div class="checkbox check"></div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" name="change">Change Password</button>
                                        </div>
                                    </form>
                                    
                                    <form method="POST" action="profile.php" role="form" class="form">
                                        <div class="well well-sm">
                                            <h4 class="text-center">Delete account</h4>
                                        </div>
                                        <small>Enter your password to confirm you want to delete your account.</small>
                                        <div class="form-group">
                                            <input type="password" name="del_password" class="form-control" placeholder="Enter password" required autocomplete="false">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-block btn-danger" name="delete">Delete Account</button>
                                            <small><label>This action can not be reversed.</label></small>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <? include "../profile_core/js_import.php"; ?>
    </body>

</html>


<script>
    $(".btn1").click(function () {
        $("#eye1").toggleClass("fa-eye-slash");
    });
    $(".btn2").click(function () {
        $("#eye2").toggleClass("fa-eye-slash");
    });
</script>