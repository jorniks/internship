
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
            ?>
        <!-- nav bar end-->

        <main class="main">

            <div class="container-fluid">

                <ul class="breadcrumb">
                    <li>You are logged in as <label class="text-capitalize"><?=$username;?></label></li>
                </ul>

                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="panel-default">
                            <div class="well well-sm bg-success">
                                <h5 class="text-center text-uppercase"><strong>Open Placements</strong></h5>
                            </div>
                            <div class="panel-body opening">
                            <?
                                if (isset($_GET['id'])) {
                                    $postID = $_GET['id'];
                                    
                                    try {
                                        $sql = "UPDATE `new_intership` SET `status`= 'closed' WHERE `id` = '$postID' AND `username` = '$username'";
                                        $con->exec($sql);
                                        header('location: placement.php');
                                    } catch (PDOException $e) {
                                        echo $sql . "<br>" . $e->getMessage();
                                    }
                                }
                                try {
                                    $stmt = $con->prepare("SELECT * FROM `new_intership` WHERE `username` = '$username' AND (`slots` > 0 AND `status` = 'open') ORDER BY `id` DESC");
                                    $stmt->execute();
                                    if($stmt->rowCount() > 0) {
                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $id = $row["id"];
                                            $employer = $row["employer"];
                                            $category = $row["category"];
                                            $slots = $row["slots"];
                                            $description = $row["description"];
                                            $start_date = $row["start_date"];
                                            $end_date = $row["end_date"];
                            ?>
                                        <div class="col-lg-3">
                                            <div class="box">
                                                <h4 class="title"><a><?= $employer; ?></a></h4>
                                                <h5><strong>Category: <?= $category; ?> </strong></h5>
                                                <p class="description">
                                                    <?= $description; ?>
                                                </p>
                                                <p><strong>Open Slots: <?= $slots; ?> </strong></p>
                                                <p><strong>Start Date: <?= $start_date; ?> </strong></p>
                                                <p><strong>End Date: <?= $end_date; ?> </strong></p>
                                                <a href="#" data-toggle="modal" data-target="#<?=$id;?>" class="btn btn-link btn-block">Close</a>
                                            </div>
                                        </div>
    <div class="modal fade" id="<?=$id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">Confirm</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p>
                            This placement still has <?=$slots;?> openings.
                        </p>
                        Do you still want to close this placement?
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary pull-right" data-dismiss="modal">No</button>
                    <a href="placement.php?id=<?=$id;?>" class="btn btn-danger pull-left" id="decline">Yes</a>
                </div>
            </div>
        </div>
    </div>
                            <?
                                        }
                                    } else {
                            ?>
                                        <div class="alert text-center">
                                            <div class="h1"><i class="fa fa-frown-o"></i></div>
                                            <label>
                                                You don't have an open internship at the moment.
                                            </label>
                                        </div>
                            <?
                                    }
                                    
                                } catch(PDOException $e) {
                                    echo $sql . "<br>" . $e->getMessage();
                                }
                            ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel-default">
                            <div class="well well-sm bg-success">
                                <h5 class="text-center text-uppercase"><strong>Closed Placements</strong></h5>
                            </div>
                            <div class="panel-body opening">
                                <?
                                try {
                                    $stmt = $con->prepare("SELECT * FROM `new_intership` WHERE `status` = 'closed' AND `username` = '$username' ORDER BY `id` DESC");
                                    $stmt->execute();
                                    if($stmt->rowCount() > 0) {
                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $id = $row["id"];
                                            $employer = $row["employer"];
                                            $category = $row["category"];
                                            $slots = $row["slots"];
                                            $description = $row["description"];
                                            $start_date = $row["start_date"];
                                            $end_date = $row["end_date"];
                            ?>
                                        <div class="col-lg-3">
                                            <div class="box">
                                                <h4 class="title"><a><?= $employer; ?></a></h4>
                                                <h5><strong>Category: <?= $category; ?> </strong></h5>
                                                <p class="description">
                                                    <?= $description; ?>
                                                </p>
                                                <p><strong>Open Slots: <?= $slots; ?> </strong></p>
                                                <p><strong>Start Date: <?= $start_date; ?> </strong></p>
                                                <p><strong>End Date: <?= $end_date; ?> </strong></p>
                                                <p>
                            <?
                                if ($slots < 1) {
                            ?>
                                <div class="form-group">
                                    <small>This placement have been exhausted. Add slots before you can open it.</small>
                                    <input class="form-control" placeholder="Number of slots to add" id="<?= $id; ?>">
                                </div>
                            <?
                                }
                            ?>
                                                </p>
                                                <button class="btn btn-link btn-block" class="open" id="<?= $id; ?>">Open</button>
                                                <a href="<?=$link?>" class="btn btn-link btn-block">Open</a>
                                            </div>
                                        </div>
                            <?
                                        }
                                    } else {
                            ?>
                                        <div class="alert text-center">
                                            <div class="h1"><i class="fa fa-smile-o"></i></div>
                                            <label>
                                                You don't have any closed internship at the moment.
                                            </label>
                                        </div>
                            <?
                                    }
                                    
                                } catch(PDOException $e) {
                                    echo $sql . "<br>" . $e->getMessage();
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