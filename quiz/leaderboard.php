<?php
	require 'core.inc.php';
	require 'sql.php';
	$te_no=$_SESSION['te_no'];
	if(!isset($_SESSION['te_no'])&& empty($_SESSION['te_no']))
	{
		header("location: ../index.php?err_messg=You are not logged in.");
	}
	else
	{
			$query4="SELECT * FROM blocked WHERE user='".$te_no."'";
			$Third_query=mysqli_query($con,$query4);
			$num_rows=mysqli_num_rows(mysqli_query($con,$query4));
			if($num_rows==0)
			{
				
				$query1="SELECT User_id,Score FROM users WHERE te_No='".$te_no."'";
				$first_query=mysqli_query($con,$query1);
				$ro1=mysqli_fetch_assoc($first_query);
				$score=$ro1["Score"];
				$user_id=$ro1["User_id"];
				$query2="SELECT name FROM question WHERE que_id='".$score."'";
				$Seconed_query=mysqli_query($con,$query2);
				$ro2=mysqli_fetch_assoc($Seconed_query);
				$name=$ro2["name"];
				$query3="Select User_id,Score FROM users ORDER BY Score Desc , Time ASC";
				$leaderboard_query=mysqli_query($con,$query3);
			}
			else
			{
				die('You have been blocked from the play');
			}
			if(isset($_REQUEST["response"]))
			{
				$response = $_REQUEST["response"];
			}
			else
			{
				$response = null;
			}
			if(isset($_REQUEST["subcode"]))
			{
				$sub = $_REQUEST["subcode"];
			}
			else
			{
				$sub = null;
			}
			
	}
?>

<!DOCTYPE HTML>

<html lang="en">
<head>
	<title>Quint Hurdle</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/icons/logo48.png"/>
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div id ="mylogo" style="z-index:5;position:absolute;width:30%;height:20%;background:url(../images/webLogo.png);background-size:100% 100%;left:35%;top:10%;"></div>
		<div class="container-login100" style="background-image: url('../images/img-01.jpg');">
			<div class="wrap-login100 p-t-190 p-b-250">
				<div class="table-wrapper">
					<table>
						<thead>
							<tr>
								<th>Rank</th>
								<th>Score</th>
								<th>Username</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=1;
							while($leaderboard = mysqli_fetch_assoc($leaderboard_query))
							{
								echo "<tr><td>".$i."</td><td>".$leaderboard["User_id"]."</td><td>".$leaderboard["Score"]."</td></tr>";$i=$i+1;
							}
							?>
						</tbody>
					</table>
				</div>

				<div class="container-login100-form-btn p-t-10">
					<button onclick="window.location.href='index.php'" class="login100-form-btn">
						Go Back
					</button>
				</div>

				<div class="container-login100-form-btn p-t-10">
					<button onclick="window.location.href='../index.php'" class="login100-form-btn">
						Logout
					</button>
				</div>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../js/main.js"></script>
	<script src="../right_click_disable.js"></script>

</body>
</html>