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
				<div id="main" class="table-wrapper" style="color:#ffffff; border-top: 1px solid #ffffff; border-bottom: 1px solid #ffffff">
					<p style="font-size:25px; color: #ffffff; text-decoration-line: underline;"><b>Level <?php echo $score+1?></b></p>
					<p id="level" target="_blank" style="font-size:20px; color: #ffffff; padding-bottom: 10px; padding-top: 10px">
						<b><?php echo $name ?></b>
					</p>
					<p>
						<form method="post" action="submission.php">
							<div class="field">
								<label for="name">Answer : </label>
								<input type="text" class="input100" name="answer" id="name" value="<?php echo $sub?>" required/>
							</div>
							<center>
							<p><?php echo $response; ?></p>
							<button class="login100-form-btn" style="margin: 10px 0px 10px 0px">
								Submit Answer
							</button>
							</center>
						</form>
									
					</p>
				</div>

				<div id="temp" class="table-wrapper" style="color:#ffffff; border-top: 1px solid #ffffff; border-bottom: 1px solid #ffffff">
					<p id="tempPara" style="font-size:25px; color: #ffffff">

					</p>
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

	<script>
		function mouseover(){
			document.getElementById('level').style.textDecorationLine="underline";
		}
		function mouseout(){
			document.getElementById('level').style.textDecorationLine="none";
		}
	</script>

	<?php 

	date_default_timezone_set('Asia/Kolkata');
	$serverTime1=date('Y-m-d H:i:s',time());
	$serverTime=date_parse($serverTime1);

	$timeQuery="SELECT startTime, endTime FROM time";
	$to1=mysqli_fetch_assoc(mysqli_query($con,$timeQuery));
	$startTime1=$to1["startTime"];
	$startTime=date_parse($startTime1);
	$endTime1=$to1["endTime"];
	$endTime=date_parse($endTime1);

	$connect=FALSE;
	$connect2=FALSE;
	$connect3=FALSE;

	if($serverTime>=$startTime && $serverTime<=$endTime){
		$connect = TRUE;
	}
	else if($serverTime>$endTime){
		$connect2 = TRUE;
	}
	else{
		$connect3 = TRUE;
	}

	?>

	<script type="text/javascript">

		var x ='<?php echo $serverTime1 ?>'
		console.log(x);
		var y ='<?php echo $startTime1 ?>'
		console.log(y);
		var z ='<?php echo $endTime1 ?>'
		console.log(z);

		Element.prototype.remove = function() {
		    this.parentElement.removeChild(this);
		}
		NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
		    for(var i = this.length - 1; i >= 0; i--) {
		        if(this[i] && this[i].parentElement) {
		            this[i].parentElement.removeChild(this[i]);
		        }
		    }
		}

		Element.prototype.add = function() {
		    this.parentElement.appendChild(this);
		}
		NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
		    for(var i = this.length - 1; i >= 0; i--) {
		        if(this[i] && this[i].parentElement) {
		            this[i].parentElement.appendChild(this[i]);
		        }
		    }
		}

		var i = "<?php echo $connect ?>";
		var j = "<?php echo $connect2 ?>";
		var k = "<?php echo $connect3 ?>";
		if(i=="1"){
			console.log('Quiz running')
			document.getElementById('main').style.visibility="visible";
			document.getElementById('temp').remove();
		}
		else if(j=="1"){
			console.log('quiz over')
			document.getElementById('main').remove();
			document.getElementById('tempPara').innerHTML="<b>Quiz is now Over</b>";

		}
		else if(k=="1"){
			console.log('there is time')
			document.getElementById('main').remove();
			document.getElementById('tempPara').innerHTML="<b>Quint Hurdle will start at 4:30 PM, 20th April</b><br><b>Quint Hurdle will end at 6:30 PM, 20th April</b><br><b>Hit reload or press ctrl + R to access quiz once quiz starts.</b>"

		}
	</script>

</body>
</html>