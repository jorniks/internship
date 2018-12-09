
<!DOCTYPE html>

<html>
    <head>
        <? include "../profile_core/profile_link.php"; ?>
    </head>

    <body>
        <!-- nav bar -->
            <?
                include "../profile_core/profile_header.php";
                $username = $_SESSION['username'];

                try {
                    $comp_stmt = $con->prepare("SELECT * FROM `comp_users` WHERE `username` = '$username'");
                    $comp_stmt->execute();
                    $comp_row = $comp_stmt->fetch(PDO::FETCH_ASSOC);

                    $orgname = $comp_row['orgname'];
                    $category = $comp_row['category'];
                    $address = $comp_row['address'];
                    $c_mail = $comp_row['email'];

                } catch (PDOException $th) {
                    echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
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
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4>New Placement</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="message">
            <?
            
                if (isset($_POST['slot'])) {
                    $slot = $_POST['slot'];
                    $duration = $_POST['duration'];
                    $s_date = $_POST['s_date'];
                    $e_date = $_POST['e_date'];
                    $description = $_POST['description'];
                    $status = "open";
                    
                    try {
                        $apply_stmt = $con->prepare("INSERT INTO `new_intership`(`employer`, `username`, `category`, `description`, `address`, `slots`, `duration`, `start_date`, `end_date`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?)");
                        $apply_success = $apply_stmt->execute(array($orgname, $username, $category, $description, $address, $slot, $duration, $s_date, $e_date, $status));
                                                    
                        if ($apply_success) {
            ?>
                            <div class="alert alert-success">Internship have been posted.</div>
            <?
                        } else {
            ?>
                            <div class="alert alert-danger">Internship failed to post. Try again</div>
            <?
                        }
                    } catch (PDOException $th) {
                        echo ("<div class='alert alert-danger'>". $th->getMessage() ."</div>");
                    }
                }
                                       
            ?>
                                    </div>
                                    <form method="POST" action="dashboard.php" class="form">
                                        <div class="form-group">
                                            <input type="text" name="slot" class="form-control" placeholder="Available Slots" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="duration" class="form-control" placeholder="Duration of internship" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="s_date" class="form-control" placeholder="Start date (dd/mm/yyyy)" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="e_date" class="form-control" placeholder="End date (dd/mm/yyyy)" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea rows="3" class="form-control" name="description" placeholder="Description of internship" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" name="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel-info">
                            <div class="panel-heading">
                                <h4>Pending Applications</h4>
                            </div>

                            <div class="panel-body">
                                <div id="alert"></div>
                                <?
                                    try {
                                        $stmt = $con->prepare("SELECT * FROM `applications` WHERE `status` = 'pending' AND `c_username` = '$username' ORDER BY `id` DESC");
                                        $stmt->execute();
                                        if($stmt->rowCount() > 0) {
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>School</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?
                                                $i = 0;
                                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $postID = $row['id'];
                                                    $student = $row['username'];
                                                    $name = $row['name'];
                                                    $email = $row['email'];
                                            ?>
                                            <tr>
                                                <td><?=$i += 1?></td>
                                                <td><?=$name;?></td>
                                                <td><?=$row['school'];?></td>
                                                <td>
                                                    &nbsp;<a href="#" data-toggle="modal" data-target="#<?=$username;?>">View Info</a> &nbsp;
                                                </td>

                        <div class="modal fade" id="<?=$username;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Student Detail</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            Name: <label><?=$name;?></label>
                                        </div>
                                        <div>
                                            Gender: <label><?=$row['gender'];?></label>
                                        </div>
                                        <div>
                                            Email: <label><?=$email;?></label>
                                        </div>
                                        <div>
                                            Phone: <label><?=$row['phonenumb'];?></label>
                                        </div>
                                        <div>
                                            Address: <label><?=$row['address'];?></label>
                                        </div>
                                        <div>
                                            School: <label><?=$row['school'];?></label>
                                        </div>
                                        <div>
                                            Department: <label><?=$row['department'];?></label>
                                        </div>
                                        <div>
                                            Course: <label><?=$row['course'];?></label>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="../../backend/update_db_info.php?postID=<?=$postID?>&student=<?=$student?>&name=<?=$name;?>&company=<?=$orgname;?>&email=<?=$email;?>&c_email=<?=$c_mail;?>&approved=1" class="btn btn-primary pull-right" id="approve">Approve</a>
                                        <a href="../../backend/update_db_info.php?postID=<?=$postID?>&student=<?=$student?>&name=<?=$name;?>&company=<?=$orgname;?>&email=<?=$email;?>&c_email=<?=$c_mail;?>&decline=1" class="btn btn-danger pull-left" id="decline">Decline</a>
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
                                            echo "<h4 class='text-center'>You have no pending applications from interns.</h4>";
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

        <? include "../profile_core/js_import.php"; ?>
    </body>

</html>

