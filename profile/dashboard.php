
<!DOCTYPE html>

<html>
    <head>

        <link href="../assets/img/interns.jpg" rel="icon">

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Interns.Ng</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css" />
    </head>

    <body>
        <!-- nav bar -->
            <?php include "../core/loggedin_header.php";?>
        <!-- nav bar end-->

        <main>

            <div class="container-fluid">
                <div class="row">
<?
    include "../backend/connection.php";

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        try {
            $user_stmt = $con->prepare("SELECT * FROM `student` WHERE `username` = '$username'");
            $user_stmt->execute();

            if ($user_stmt->rowCount() > 0) {
                header('location: student/dashboard.php');
            } else {
                $comp_stmt = $con->prepare("SELECT * FROM `comp_users` WHERE `username` = '$username'");
                $comp_stmt->execute();

                if ($comp_stmt->rowCount() > 0) {
                    header('location: company/dashboard.php');
                } else {
                    $admin_stmt = $con->prepare("SELECT * FROM `admin` WHERE `username` = '$username'");
                    $admin_stmt->execute();
        
                    if ($admin_stmt->rowCount() > 0) {
                        header('location: admin_dashboard.php');
                    } else {
                        session_destroy();
                        header('location: ../login.php');
                    }
                }
            }
            
        } catch (PDOException $th) {
            echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
        }
    } else {
        header('location: ../login.php');
    }

?>
                </div>
            </div>

        </main>
    </body>

</html>