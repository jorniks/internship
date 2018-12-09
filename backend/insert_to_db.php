
<?

    include "connection.php";
    session_start();

    //COMPANY REGISTRATION SCRIPT
    if (isset($_GET['company'])) {
        $category = $_GET['category'];
        $name = $_GET['company'];
        $email = $_GET['email'];
        $address = $_GET['address'];
        $username = $_GET['username'];
        $password = trim(sha1($_GET['password']));

        
        try {
            $stmt = $con->prepare("SELECT `username` FROM `comp_users` WHERE `username` = '$username'");
            $stmt->execute();
            $smt = $con->prepare("SELECT `email` FROM `comp_users` WHERE `email` = '$email'");
            $smt->execute();
            if ($smt-> rowCount() > 0) {
                echo("3");
            } elseif ($stmt-> rowCount() > 0) {
                echo("2");
            } else {
                $comp_stmt = $con->prepare("INSERT INTO `comp_users`(`orgname`, `category`, `username`, `address`, `email`, `password`) VALUES (?,?,?,?,?,?)");
                $co = $comp_stmt->execute(array($name, $category, $username, $address, $email, $password));
                if ($co) {
                    $_SESSION['username'] = $username;
                    echo("1");
                } else {
                    echo ("<div class='alert alert-danger'>Registration failed.</div>");
                }
            }
        } catch (PDOException $th) {
            echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
        }
    }
    
    //STUDENT REGISTRATION SCRIPT
    elseif (isset($_GET['student'])) {
        $name = $_GET['student'];
        $email = $_GET['email'];
        $username = $_GET['username'];
        $password = trim(sha1($_GET['password']));

        try {
            $stmt = $con->prepare("SELECT `username` FROM `student` WHERE `username` = '$username'");
            $stmt->execute();
            $smt = $con->prepare("SELECT `email` FROM `student` WHERE `email` = '$email'");
            $smt->execute();
            if ($smt-> rowCount() > 0) {
                echo("3");
            } elseif ($stmt-> rowCount() > 0) {
                echo("2");
            } else {
                $student_sql = "INSERT INTO `student`(`name`, `username`, `email`, `password`) VALUES ('$name','$username','$email','$password')";
                if ($con->exec($student_sql)) {
                    $_SESSION['username'] = $username;
                    echo 1;
                } else {
                    echo ("<div class='alert alert-danger'>Registration failed.</div>");
                }
            }
            
        } catch (PDOException $th) {
            echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
        }
    }

    //INTERSHIP APPLICATION SCRIPT
    else if (isset($_POST['postID'])) {
        $postID = $_POST['postID'];
        $c_username = $_POST['c_username'];
        $username = $_SESSION['username'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $school = $_POST['school'];
        $duration = $_POST['duration'];
        $department = $_POST['department'];
        $course = $_POST['course'];
        $status = "pending";

        try {
            $apply_stmt = $con->prepare("INSERT INTO `applications`(`postID`, `c_username`, `username`, `name`, `gender`, `email`, `phonenumb`, `address`, `school`, `duration`, `department`, `course`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $apply_success = $apply_stmt->execute(array($postID, $c_username, $username, $name, $gender, $email, $phone, $address, $school, $duration, $department, $course, $status));
            
            if ($apply_success) {
                $sql = "UPDATE `new_intership` SET `slots`= slots-1 WHERE `id` = '$postID' AND `username` = '$c_username'";
                $con->exec($sql);

                $stmt = $con->prepare("SELECT * FROM `new_intership` WHERE `id` = '$postID' AND `username` = '$c_username'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if($row['slots'] <= 0) {
                    $sql = "UPDATE `new_intership` SET `status` = 'closed' WHERE `id` = '$postID' AND `username` = '$c_username'";
                    $con->exec($sql);
                }
                echo("1");
            } else {
                echo ("2");
            }
        } catch (PDOException $th) {
            echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
        }
    }
?>