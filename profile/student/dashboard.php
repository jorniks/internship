
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

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12 opening">
                            
                        <?
                            try {
                                $id_stmt = $con->prepare("SELECT * FROM `applications` WHERE `username` = '$username' ORDER BY `id` DESC");
                                $id_stmt->execute();
                                if($id_stmt->rowCount() > 0) {
                        ?>
                                <div class="well well-sm">
                                    <h4 class="text-center">Internships you applied for</h4>
                                </div>
                        <?
                                    while($id_row = $id_stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $postID = $id_row["postID"];
                                        $status = $id_row["status"];
                                        
                                        $link = "../../backend/delete_from_db.php?postID=$postID&username=$username";

                                        $stmt = $con->prepare("SELECT * FROM `new_intership` WHERE `id` = '$postID'");
                                        $stmt->execute();

                                        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $employer = $row["employer"];
                                            $category = $row["category"];
                                            $description = $row["description"];
                                            $slots = $row["slots"];
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
                                            <p><strong>Application Status: <?= $status; ?> </strong></p>
                                            <a href="<?=$link?>" class="btn btn-link btn-block">Cancel</a>
                                        </div>
                                    </div>
                        <?
                                        }
                                    }
                                } else {
                        ?>
                                    <div class="alert text-center">
                                        <label>
                                            You have not applied for any intership. <a href="../../index.php">Click here</a> to find intership that will suit you.
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

        </main>

        <? include "../profile_core/js_import.php"; ?>
    </body>

</html>