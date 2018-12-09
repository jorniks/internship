

<?
    include "connection.php";

    //QUERY FOR LOGIN FORM
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = trim(sha1($_POST['password']));

        try {
            $user_stmt = $con->prepare("SELECT * FROM `student` WHERE `username` = '$username'");
            $user_stmt->execute();
            if ($user_stmt->rowCount() > 0) {
                $row = $user_stmt->fetch(PDO::FETCH_ASSOC);
                if ($row['password'] == $password) {
                    session_start();
                    $_SESSION['username'] = $username;
                    echo("3");
                } else {
                    echo("2");
                }
            } else {
                $comp_stmt = $con->prepare("SELECT * FROM `comp_users` WHERE `username` = '$username'");
                $comp_stmt->execute();
                
                if ($comp_stmt->rowCount() > 0) {
                    $comp_row = $comp_stmt->fetch(PDO::FETCH_ASSOC);
                    if ($comp_row['password'] == $password) {
                        session_start();
                        $_SESSION['username'] = $username;
                        echo("3");
                    } else {
                        echo("2");
                    }
                } else {
                    $admin_stmt = $con->prepare("SELECT * FROM `admin` WHERE `username` = '$username'");
                    $admin_stmt->execute();
    
                    if ($admin_stmt->rowCount() > 0) {
                        $admin_row = $admin_stmt->fetch(PDO::FETCH_ASSOC);
                        if ($admin_row['password'] == $password) {
                            session_start();
                            $_SESSION['username'] = $username;
                            echo("4");
                        } else {
                            echo("2");
                        }
                    } else {
                        echo("1");
                    }
                }
                
            }
            
        } catch (PDOException $th) {
            echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
        }
    }

?>