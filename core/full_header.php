
<?
    session_start();
?>

	<nav class="navbar navbar-default navbar-fixed-top">
      	<div class="container">
        	<div class="navbar-header">
          		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            		<span class="icon-bar"></span>
	            	<span class="icon-bar"></span>
	            	<span class="icon-bar"></span>                        
                </button>
	          	<a class="navbar-brand" href="index.php"><img src="assets/img/in.png" style="width: 150px; height: 60px;"></a>
	        </div>

            <? if (!isset($_SESSION['username'])) { ?>

                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul id="nav-ul" class="nav navbar-nav navbar-right">
                        <li id="ul-li"><a href="index.php">Home</a></li>
                        <li id="ul-li"><a href="about.php">About Us</a></li>
                        <li id="ul-li"><a id="si" href="comp_signup.php">JOIN AS COMPANY</a></li>
                        <li id="ul-li"><a id="li" href="sign_up.php">JOIN AS STUDENT</a></li>
                        <li id="ul-li"><a id="li" href="login.php"><img src="assets/img/admin.png" width="20px" height="20px"></a></li>
                    </ul>
                </div>
            
			<? } else {
			?>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul id="nav-ul" class="nav navbar-nav navbar-right">
                        <li id="ul-li"><a href="profile/dashboard.php">Dashboard</a></li>
                        <li id="ul-li"><a href="profile/profile.php">Profile</a></li>
                        <li id="ul-li"><a href="logout.php" style="color:red;">Log Out</a></li>
                    </ul>
                </div>
			<? } ?>
      	</div>
    </nav>