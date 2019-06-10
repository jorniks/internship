
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
        <nav class="navbar navbar-default navbar-fixed-top">
      	<div class="container">
        	<div class="navbar-header">
          		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            		<span class="icon-bar"></span>
	            	<span class="icon-bar"></span>
	            	<span class="icon-bar"></span>                        
                </button>
	          	<a class="navbar-brand" href="../index.php"><img src="../assets/img/in.png" style="width: 150px; height: 60px;"></a>
            </div>
            
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul id="nav-ul" class="nav navbar-nav navbar-right">
                    <li id="ul-li"><a href="../logout.php" style="color:red;">Log Out</a></li>
                </ul>
            </div>
      	</div>
    </nav>
            <?
                session_start();
                include "../backend/connection.php";
                $username = $_SESSION['username'];

                if (!isset($_SESSION['username'])) {
                    header('location: ../login.php');
                }
            ?>
        <!-- nav bar end-->

        <main class="main">

            <div class="container-fluid">

                <ul class="breadcrumb">
                    <li>You are logged in as <label class="text-capitalize"><?=$username;?></label></li>
                </ul>

                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel-info">
                            <div class="panel-heading">
                                <h4>Registered Companies</h4>
                            </div>

                            <div class="panel-body">
                                <div id="alert"></div>
                                <?
                                    try {
                                        $stmt = $con->prepare("SELECT * FROM `comp_users` WHERE 1 ORDER BY `id` DESC");
                                        $stmt->execute();
                                        if($stmt->rowCount() > 0) {
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Company</th>
                                                <th>Category</th>
                                                <th>Address</th>
                                                <th>Placements</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?
                                                $i = 0;
                                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $postID = $row['id'];
                                                    $company = $row['username'];
                                                    $link = "dashboard.php?postID=$postID&company=$company";

    $comp_stmt = $con->prepare("SELECT COUNT(*) AS listings FROM `new_intership` WHERE `username` = '$company'");
    $comp_stmt->execute();
    $comp_row = $comp_stmt->fetch(PDO::FETCH_ASSOC);

    $pending_sql = $con->prepare("SELECT COUNT(*) AS pending FROM `applications` WHERE `status` = 'pending' AND `username` = '$company'");
    $pending_sql->execute();
    $pending_row = $pending_sql->fetch(PDO::FETCH_ASSOC);

    $approved_sql = $con->prepare("SELECT COUNT(*) AS approved FROM `applications` WHERE `status` = 'approved' AND `username` = '$company'");
    $approved_sql->execute();
    $approved_row = $approved_sql->fetch(PDO::FETCH_ASSOC);

    $application_stmt = $con->prepare("SELECT COUNT(*) AS total FROM `applications` WHERE `username` = '$company'");
    $application_stmt->execute();
    $application_row = $application_stmt->fetch(PDO::FETCH_ASSOC);

                                            ?>
                                            <tr>
                                                <td><?=$i += 1?></td>
                                                <td><?=$row['orgname'];?></td>
                                                <td><?=$row['category'];?></td>
                                                <td><?=$row['address'];?></td>
                                                <td><?=$comp_row['listings'];?></td>
                                                <td>
                                                        &nbsp;
                                                    <button class="btn btn-default" data-toggle="modal" data-target="#<?=$row['username'];?>">View Info</button>
                                                        &nbsp; | &nbsp;
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#<?=$row['id'];?>">Delete</button>
                                                </td>

                        <div class="modal fade" id="<?=$row['username'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Company Detail</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            Company: <label class="text-capitalize"><?=$row['orgname'];?></label>
                                        </div>
                                        <div>
                                            Username: <label><?=$row['username'];?></label>
                                        </div>
                                        <div>
                                            Category: <label><?=$row['category'];?></label>
                                        </div>
                                        <div>
                                            Email: <label><?=$row['email'];?></label>
                                        </div>
                                        <div>
                                            Phone: <label><?=$row['phone'];?></label>
                                        <div>
                                            Total Placements: <label><?=$comp_row['listings'];?></label>
                                        </div>
                                        </div>
                                        <div>
                                            Approved Applications: <label><?=$approved_row['approved'];?></label>
                                        </div>
                                        <div>
                                            Pending Applications: <label><?=$pending_row['pending'];?></label>
                                        </div>
                                        <div>
                                            Total Applications: <label><?=$application_row['total'];?></label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="<?=$row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <label class="text-capitalize"><?=$row['orgname'];?></label> and all data related to it including internship placements will be permanently deleted.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary pull-right" data-dismiss="modal">Cancel</button>
                                        <a href="../backend/delete_from_db.php?postID=<?=$postID?>&company=<?=$company?>" class="btn btn-danger pull-left" id="decline">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                                            </tr>
                                            <?
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?
                                        } else {
                                            echo "<h4 class='text-center'>There are no companies registered on the platform at the moment.</h4>";
                                        }
                                    } catch (PDOException $th) {
                                        echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
                                    }

                                ?>
                            </div>
                        </div>
                    </div>

                    <!--============================================================================
                                            MESSAGES PANE
                    =============================================================================-->

                    <div class="col-md-4">
                            <div class="panel-info">
                            <div class="panel-heading">
                                <h4>Posted Messages</h4>
                            </div>

                            <div class="panel-body">
                                <div id="alert"></div>
                                <?
                                    try {
                                        $msgSQL = $con->prepare("SELECT * FROM `message` WHERE 1 ORDER BY `id` DESC");
                                        $msgSQL->execute();
                                        if($msgSQL->rowCount() > 0) {
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <!-- <th>Name</th> -->
                                                <th>Email</th>
                                                <th>Date | Time</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?
                                                $i = 0;
                                                while($row = $msgSQL->fetch(PDO::FETCH_ASSOC)) {
                                                    $hour = date('h', $row['time'])-1;
                                                    $minute = date(':i a', $row['time']);
                                                    $date = date('F d, Y', $row['time']);

                                                    $time = $date . " | " . $hour.$minute;
                                            ?>
                                            <tr>
                                                <td><?=$i += 1?></td>
                                                <td><?=$row['email'];?></td>
                                                <td><?=$time?></td>
                                                <td>
                                                        &nbsp;
                                                    <button class="btn btn-default" data-toggle="modal" data-target="#<?=$row['id'];?>">View</button>
                                                        &nbsp; | &nbsp;
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#del<?=$row['id'];?>">Delete</button>
                                                </td>

                        <div class="modal fade" id="<?=$row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Message Detail</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            Name: <label class="text-capitalize"><?=$row['name'];?></label>
                                        </div>
                                        <div>
                                            Email: <label><?=$row['email'];?></label>
                                        </div>
                                        <div>
                                            Message: <p><?=$row['message'];?></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="del<?=$row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            This message from <label class="text-capitalize"><?=$row['name'];?></label> will be permanently deleted.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary pull-right" data-dismiss="modal">Cancel</button>
                                        <a href="../backend/delete_from_db.php?message=<?=$row['id']?>" class="btn btn-danger pull-left" id="decline">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                                            </tr>
                                            <?
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?
                                        } else {
                                            echo "<h4 class='text-center'>There are no messages saved at the moment.</h4>";
                                        }
                                    } catch (PDOException $th) {
                                        echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
                                    }

                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </main>

        <!-- footer-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright">
                    &copy; <strong><a href="../index.php">interns.ng</a></strong> 2018 All rights reserved.
                </div>
                <div class="credits">
                    <span id="pfooter" class="text-left">Powered by: EDU-SMART SYSTEMS</span>
                </div>
            </div>
        </footer>
        <!-- footer end-->


        <button class="back-to-top" title="Back to top"><i class="fa fa-chevron-up"></i></button>

        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/main.js"></script>
    </body>

</html>

