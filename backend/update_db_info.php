

<?
    include "connection.php";

    if (isset($_GET['approved'])) {
        $student = $_GET['student'];
        $postID = $_GET['postID'];
        $name = $_GET['name'];
        $email = $_GET['email'];
        $company = $_GET['company'];
        $c_email = $_GET['c_email'];

        $subject = "Congratulations " . $name;

        $message = "Dear " . $name . ",\n\n
                Your application for internship with " . $company . " was received and approved. You are expected to resume 3 working days from today and be at your best behavior throughout the period of your internship. \n\n\n
                Best regards.";

        try {
            $update_sql = "UPDATE `applications` SET `status`='approved' WHERE `username` = '$student' AND `id`= '$postID'";
            
            if ($con->exec($update_sql)) {
                require '../vendor/autoload.php';
                include "../core/mail.php";

                sendMail($company, $c_email, $subject, $email, $message);
            }
            
            header('location: ../profile/dashboard.php');
        } catch (PDOException $th) {
            echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
        }
    } elseif (isset($_GET['decline'])) {
        $student = $_GET['student'];
        $postID = $_GET['postID'];
        $name = $_GET['name'];
        $email = $_GET['email'];
        $company = $_GET['company'];
        $c_email = $_GET['c_email'];

        $subject = "Application Declined for " . $name;

        $message = "Dear " . $name . ",\n\n
                Your application for internship with " . $company . " was received but declined. We are sorry not to accept your application but we wish you the best of luck and suggest you try other organizations. \n\n\n
                Best regards.";

        try {
            $update_sql = "UPDATE `applications` SET `status`='declined' WHERE `username` = '$student' AND `id`= '$postID'";
            
            if ($con->exec($update_sql)) {
                require '../vendor/autoload.php';
                include "../core/mail.php";

                sendMail($company, $c_email, $subject, $email, $message);
            }
            
            header('location: ../profile/dashboard.php');
        } catch (PDOException $th) {
            echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
        }
    }
?>