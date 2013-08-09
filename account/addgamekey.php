<?php
session_start();

if(!isset($_SESSION['userORM'])){
	header("Location: http://localhost/mmo.tm/divinesouls");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style> 
		/* Start of "Micro clearfix" */

		.cf { zoom: 1; }
		.cf:before,
		.cf:after { content: ""; display: table; }
		.cf:after { clear: both; }

		/* End of "Micro clearfix" */

		body { width: 100%; margin: 0 auto;}
	</style>

	<title>Management</title>

	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />

	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css" />

	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../js/paypal-button.min.js" type="text/javascript"></script>
	<script src="../js/general.js?ver=1.02" type="text/javascript"></script>

	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Gudea" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Russo+One" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Univers" />
	
</head>

		<body>
			<div class = "body-mgmt">
				<div id="vessel" style="height: 1072px;">
					<?php include("../includes/_menu.php"); ?>
					<?php
					if(isset($_SESSION['userORM'])){

						$username = $_SESSION['userORM'];

			mysql_connect("localhost", "root", "") or die(mysql_error()); // Connect to database server(localhost) with username and password.  
			mysql_select_db("anytv_divineSoulsUsers") or die(mysql_error()); // Select registration database. 

			$result = mysql_query("SELECT * FROM Users WHERE email = '$username'") or die(mysql_error());

			while($row = mysql_fetch_array($result))
			{
				$email = $row['email'];
				$fullName = $row['fullName'];
				$mmoTag = $row['mmoTag'];
				$country = $row['country'];
				$mmoPoints = $row['mmoPointBalance'];
				$divineSoulsActive = $row['keyActive'];
				$mmoPointBalance = $row['mmoPointBalance'];
			}
		}
		?>
		<div id="seek" >
			<span id="scout1" >
				<form action="http://www.mmo.tm/account/account.php?view=1" method="#" >
					<input id="submitmgmtsearch" type="text" placeholder="Search" id="pass" required/>
					<input id="submitmgmt2" type="submit" value="" name="submit" />
				</form>
			</span>
		</div>

		<div class="content-wrap" style="margin-top: 130px;">
			<div class="content">
				
				<nav>
					<div class="nav_2"><img src="images/my-account-icon.png"/></div>

					<div class="nav_1" style="width: 95px;"><a style="margin-right: 50px;" href="/mmo.tm/account/account.php?view=4">Summary</a></div>
					<div id="nav_1" class="btn-group dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">

							<span class="userInfoHeader">Settings</span>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
							<li><a href="/mmo.tm/account/management/settings/account-reset.php">Account Reset</a></li>
							<li><a href="/mmo.tm/account/management/settings/password-reset.php">Password Reset</a></li>
						</ul>
					</div>
					<div id="nav_1" class="btn-group dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">

							<span class="userInfoHeader">Games & Codes</span>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
							<li><a href="/mmo.tm/account/addgamekey.php">Add a game key</a></li>
							<li><a href="/mmo.tm/account/downloadgameclient.php">Download game clients</a></li>
						</ul>
					</div>

					<div id="nav_1" class="btn-group dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">

							<span class="userInfoHeader">Transaction History</span>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
							<li><a href="/mmo.tm/account/orderhistory.php">Order History</a></li>
							<li><a href="/mmo.tm/account/balancehistory.php">Balance History</a></li>
						</ul>
					</div>
					<div id="account_balance">

						<span>
							<b id="cur_balance"><?php echo $mmoPointBalance; ?></b>
							&nbsp;mmoPts
						</span></br>
						<a href="purchase.php" onclick="
						<?php if(!isset($_SESSION['userORM'])){ 
							echo "alert('You need to be logged in to charge points.');return false;";
						}else{
							echo "return true";
						}?>
						">
						<img src="images/charge.png" id="charge_balance" />
					</a>
				</div>
			</nav>
		</div>
	</div>

	<div class="content-wrap">
		<div id="addgamekey-wrapper">
			<div id="addgamekey">
				<span>GAME MANAGEMENT</span>
				<h1>Code Redemption</h1>
				<hr>
				<span>Use this page to redeem game keys, game time codes, game item codes, and pre-paid cards for Battle.net balance.</span>
			</div>
			<div id ="gamekeybox">
				<?php
				if(isset($_SESSION['userORM'])){
					$user_id=$_SESSION['userORM'];

					$get_id = mysql_query("SELECT * FROM users WHERE email = '$user_id'");
					while($row = mysql_fetch_array($get_id))
					{
						$id = $row['id'];
						$mmoPointBalance = $row['mmoPointBalance'];
					}
					if(isset($_POST['gamekey'])){
						$game_key = $_POST['gamekey'];
						$get_gk = mysql_query("SELECT * FROM gamekeys WHERE keysgame='$game_key'");
						if(mysql_num_rows($get_gk)!=0){
							while($row2 = mysql_fetch_array($get_gk))
							{
								$perks = $row2['perks'];
								$status = $row2['used'];
							}
							if($status==0){
							$new_mmoBalance = $perks+$mmoPointBalance;
							mysql_query("UPDATE users SET mmoPointBalance = '$new_mmoBalance' WHERE id='$id'"); //update new balance for the mmoPoints
							mysql_query("UPDATE gamekeys SET used='1' WHERE keysgame='$game_key'");
							echo('<meta http-equiv="refresh" content=".00001">'); 
							}else{
								echo "<div style='position: absolute;text-align: center;width: 420px;'>GAME KEY USED!</div>";
							}
						
						}
					}

				}
				?>
				<form method="post" action="addgamekey.php" >
					<p>Enter Code</p>
					<input type="text" name="gamekey" maxlength="320" tabindex="1" required/>
					<button type ="submit" class="btn btn-primary">REDEEM CODE</button>
				</form>
			</div>
			<div id="gamekeyhelp">

				<h2 style="float:left;">Need help?</h2>
				<span><a href="#" class="gamekey-mail">Click here</a></span>
			</div>
		</div>
	</div>


	<div class="content-wrap" style="margin-top:240px;">
		<div id="pre_footer">
			<div id="supplinks"><p>Support</p>
				<p id="cantlog"><a href="../divinesouls/forum/index.php">Forum Support</a><br/>
					<a href="mailto:sheldon@any.tv?Subject=Help" target="_top">Help!</a><br/>
				</div>
				<div id="acchead"></p>Account</p>
					<p id="cantlog"><a href="mailto:sheldon@any.tv?Subject=Can't%20Login" target="_top">Can't log in?</a><br/>
						<a href="../divinesouls/signup.php">Create Account</a><br/>
						<a href="../account/account.php?view=1">Account Summary</a><br/>

					</div>
				</div>
			</div>


			<div class="content-wrap">
				<div id="footer">
					<div id="amanytv">
						part of the <a href="http://www.any.tv" title="any.TV" id="amanytvlogo" >any.TV</a> family
					</div><!--end anytv-->
					<div id="amfooter">
						Copyright &copy; 2013 any.TV. All Rights Reserved.					
					</div>
					<!--end footer-->
				</div>
			</div>
		</div>
	</div>
</body>

</html>