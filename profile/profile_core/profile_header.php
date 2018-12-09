
<?
    session_start();

    if (!isset($_SESSION['username'])) {
        header("location: ../../login.php");
    }
?>

	<nav class="navbar navbar-default navbar-fixed-top">
      	<div class="container">
        	<div class="navbar-header">
          		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            		<span class="icon-bar"></span>
	            	<span class="icon-bar"></span>
	            	<span class="icon-bar"></span>                        
                </button>
	          	<a class="navbar-brand" href="../../index.php"><img src="../../assets/img/in.png" style="width: 150px; height: 60px;"></a>
	        </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul id="nav-ul" class="nav navbar-nav navbar-right">
                    <li id="ul-li"><a href="../../profile/dashboard.php">Dashboard</a></li>
                    <li id="ul-li"><a href="../../profile/profile.php">Profile</a></li>
                    <?
                        if (isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];
                            try {
                                $stmt = $con->prepare("SELECT `username` FROM `comp_users` WHERE `username`= '$username'");
                                $stmt->execute();
                                if($stmt->rowCount() > 0) {
                    ?>
                    <li id="ul-li"><a href="../../profile/company/placement.php">Placements</a></li>
                    <?
                                }
                                
                            } catch(PDOException $e) {
                                echo $sql . "<br>" . $e->getMessage();
                            }
                        }
                    ?>
                    <li id="ul-li"><a href="../../logout.php" style="color:red;">Log Out</a></li>
                </ul>
            </div>
      	</div>
    </nav>