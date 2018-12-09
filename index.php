
<!DOCTYPE html>

<html>
    <head>

        <link href="assets/img/interns.jpg" rel="icon">

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Interns.Ng</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    </head>

    <body>
        <!-- nav bar -->
            <?php include "core/full_header.php";?>
        <!-- nav bar end-->

        <main>
            <div class="container-fluid">
                
                
                <div class="row">
                    <!-- Welcome face-->
                    <div id="face">
                        <div class=" text-center">
                            <div class="categories">
                                <h2>The Easiest Way To Get Your Internship Placements</h2>
                                <form action="search.php" method="GET" class="form-inline">
                                    <div class="form-group">
                                        <input type="text" placeholder="Company Name" size="80" class="form-control" name="company" required>
                                        <button type="submit" class="btn btn-primary" name="search_item">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Welcome face end-->
                </div>

                <div class="row">
                    <!-- latest openings-->
                    <div class="opening">
                        <h2 class="text-center caption"> New Openings </h2>

                        <?
                            include "backend/connection.php";
                            
                            try {
                                $stmt = $con->prepare("SELECT * FROM `new_intership` WHERE `status` = 'open' AND `slots` > 0 ORDER BY `id` DESC LIMIT 8");
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

                                        $link = "apply.php?organization=$employer&category=$category&description=$description&username=$username&postID=$postID";
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
                                            There is no listing available at the moment. Check again soon.
                                        </label>
                                    </div>
                        <?
                                }
                                
                            } catch(PDOException $e) {
                                echo $sql . "<br>" . $e->getMessage();
                            }
                        ?>
                        
                    </div>
                    <!-- latest openings-->
                </div>

                <div class="row">
                    <!-- Popular Categories-->
                    <div id="cats" class=" text-center">
                        <div class="items">

                            <h2 class="text-center caption">Categories </h2><hr>

                            <div class="col-lg-4">
                                <div class="box">
                                    <div class="icon"><i><img src="assets/img/tele.png" alt="Communication"></i></div>
                                    <h4 class="title"><a href="category/category.php?category=communication">Communication</a></h4>
                                    <p class="description">
                                        Take a career in ICT and learn the perks of communication with any Nigerian telecommunication industry.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="box">
                                    <div class="icon"><i><img src="assets/img/home.png" alt="Construction"></i></div>
                                    <h4 class="title"><a href="category/category.php?category=construction">Construction</a></h4>
                                    <p class="description">
                                        Take a career in ICT and learn the perks of communication with any Nigerian telecommunication industry.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="box">
                                    <div class="icon"><i><img src="assets/img/tools.png" alt="Engineering"></i></div>
                                    <h4 class="title"><a href="category/category.php?category=engineering">Engineering</a></h4>
                                    <p class="description">
                                        Take a career in ICT and learn the perks of communication with any Nigerian telecommunication industry.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="box">
                                    <div class="icon"><i><img src="assets/img/agric.png" alt="Agriculture"></i></div>
                                    <h4 class="title"><a href="category/category.php?category=agriculture">Agriculture</a></h4>
                                    <p class="description">
                                        Take a career in ICT and learn the perks of communication with any Nigerian telecommunication industry.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="box">
                                    <div class="icon"><i><img src="assets/img/clock.png" alt="Banking and Finance"></i></div>
                                    <h4 class="title"><a href="category/category.php?category=banking %26 finance">Banking &amp; Finance</a></h4>
                                    <p class="description">
                                        Take a career in ICT and learn the perks of communication with any Nigerian telecommunication industry.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="box">
                                    <div class="icon"><i><img src="assets/img/music.png" alt="Art and Media"></i></div>
                                    <h4 class="title"><a href="category/category.php?category=art %26 Media">Art &amp; Multimedia</a></h4>
                                    <p class="description">
                                        Take a career in ICT and learn the perks of communication with any Nigerian telecommunication industry.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="box">
                                    <div class="icon"><i><img src="assets/img/ad.png" alt="Health"></i></div>
                                    <h4 class="title"><a href="category/category.php?category=health">Health</a></h4>
                                    <p class="description">
                                        Take a career in ICT and learn the perks of communication with any Nigerian telecommunication industry.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="box">
                                    <div class="icon"><i><img src="assets/img/science.png" alt="Science"></i></div>
                                    <h4 class="title"><a href="category/category.php?category=science">Science</a></h4>
                                    <p class="description">
                                        Take a career in ICT and learn the perks of communication with any Nigerian telecommunication industry.
                                    </p>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div>
                                <a href="category/category.php?category=others" class="btn btn-link">Other Categories</a>
                            </div>
                        </div>
                    </div>
                    <!-- Popular Categories end-->
                </div>

                <div class="row">
                    <!-- Contact Section -->
                        <div class="col-md-12 contact">

                            <h2 class="text-center caption">CONTACT US</h2>

                            <div class="col-md-6">
                                <p>
                                    Contact us and we'll get back to you within 24 hours.
                                </p>
                                <p><span ></span> Jos, Nigeria</p>
                                <div class="contact-info">
                                    <div>
                                        <i class="fa fa-phone"></i>
                                        <span>+234 8065587751, +234 8137725705</span>
                                    </div>
                                    
                                    <h4 class="caption">Follow us on Social media</h4>
                                    <div class="col-md-3">
                                        <a href="mailto:YOUR_EMAIL_ADDRESS" id="alert"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="http://facebook.com/kingsley.james.376"><i class="fa fa-facebook"></i></a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="http://twitter.com/apoyibo"><i class="fa fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 form">
                                <h4 class="caption">Send us a mail</h4>
                                <form action="index.php" method="POST" role="form">
        <?
            if (isset($_POST['message'])) {
                $name = $_POST['name'];
                $sender = $_POST['email'];
                $message = $_POST['message'];
                $subject = "Treat as urgent";
                $receiver = "YOUR_EMAIL_ADDRESS";

                require 'vendor/autoload.php';

                include "core/mail.php";

                sendMail($name, $sender, $subject, $receiver, $message);
            }
        ?>
                                <div class="form-group">
                                    <input class="form-control" name="name" placeholder="Your Name" type="text" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="email" placeholder="Your Email" type="email" required>
                                </div>
                                    
                                <div class="form-group">
                                    <textarea class="form-control" name="message" placeholder="Your message" rows="5" required></textarea>
                                </div>

                                <button class="btn btn-primary btn-block" type="submit">Send</button>
                                </form>    
                            </div>

                        </div>
                    <!-- Contact Section end-->

                </div>

            </div>
        </main>
        
        <?include "core/footer.php";?>
        

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
