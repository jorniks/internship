

<?
    include "connection.php";
    
    if (isset($_GET['username'])) {
        $postID = $_GET['postID'];
        $username = $_GET['username'];

        try {
            $sql = "DELETE FROM `applications` WHERE `postID`= '$postID' AND `username` = '$username'";
            $con->exec($sql);

            $update_stmt = $con->prepare("UPDATE `new_intership` SET `slots`= slots+1,`status`='open' WHERE `id` = '$postID'");
            $update_stmt->execute();

            header('location: ../profile/dashboard.php');
        } catch (PDOException $th) {
            header('location: ../profile/dashboard.php');
        }
    } elseif (isset($_GET['company'])) {
        $company = $_GET['company'];

        try {
            $app_del = "DELETE FROM `applications` WHERE `c_username`= '$company'";
            $con->exec($app_del);

            $placement_del = "DELETE FROM `new_intership` WHERE `username` = '$company'";
            $con->exec($placement_del);

            $comp_del = "DELETE FROM `comp_users` WHERE `username`= '$company'";
            $con->exec($comp_del);

            header('location: ../profile/admin_dashboard.php');
        } catch (PDOException $th) {
            header('location: ../profile/admin_dashboard.php');
        }
    }
?>