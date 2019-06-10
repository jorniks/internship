
<!DOCTYPE html>

<html>
    <head>
        <link href="../assets/img/interns.jpg" rel="icon">

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Intern.Ng</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css" />
    </head>

    <body>

        <? include "../core/loggedin_header.php"; ?>
        
        <main class="main">
            <div class="container-fluid">
                <?
                    require "../backend/connection.php";

                    if (!isset($_GET['category'])) {
                        header('location: ../index.php');
                    } else {
                        $cat = explode(" ", $_GET['category']);
                        $exploded = $cat[0];
                    }
                ?>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="jumbotron">
                            <h2 class="text-primary text-center text-capitalize"><?=$_GET['category'];?></h2>
                        </div>
                    </div>

                    <div class="row opening">

                        <?
                            try {
                                $stmt = $con->prepare("SELECT * FROM `new_intership` WHERE `category`= '$exploded' AND (`slots` > 0 AND `status` = 'open') ORDER BY rand()");
                                $stmt->execute();
                                if($stmt->rowCount() > 0) {
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $postID = $row['id'];
                                        $username = $row['username'];
                                        $employer = $row["employer"];
                                        $description = $row["description"];
                                        $slots = $row["slots"];
                                        $category = $row["category"];
                                        $start_date = $row["start_date"];
                                        $end_date = $row["end_date"];

                                        $link = "../apply.php?organization=$employer&category=$category&description=$description&username=$username&postID=$postID";
                        ?>
                                    <div class="col-lg-3">
                                        <div class="box">
                                            <h4 class="title"><a><?= $employer; ?></a></h4>
                                            <p class="description">
                                                <?= $description; ?>
                                            </p>
                                            <p><strong>Open Slots: <?= $slots; ?> </strong></p>
                                            <p><strong>Start Date: <?= $start_date; ?> </strong></p>
                                            <p><strong>End Date: <?= $end_date; ?> </strong></p>
                                            <a href="<?=$link?>" class="btn btn-link btn-block">Apply</a>
                                        </div>
                                    </div>
                        <?
                                    }
                                } else {
                        ?>
                                    <div class="alert text-center">
                                        <div class="h1"><i class="fa fa-frown-o"></i></div>
                                        <label>
                                            There is no listing under this category at the moment. Check again soon.
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
        </main>

        <? include "../core/footer.php"; ?>

        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/main.js"></script>
    </body>
</html>