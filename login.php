<?php
require 'sql.php';
require 'core.inc.php';

//Sql query to fetch the password of the input Enrollment No.
if(!isset($_POST['te_no']) || empty($_POST['te_no']))
{
	header("location: index.php?err_messg=Enter the Enrollment Number#intro"); //redirecting to the registration page with a error message
}

// Assigning the value to the Er_no
if(isset($_POST['te_no']) && !empty($_POST['te_no']))
{
	$te_no=htmlentities(strtolower($_POST['te_no']));
}
else
{
	header("Location: index.php?err_messg=Invalid Team Name#intro");
}

//Assigning and fetching the Password
if(!isset($_POST['psswd']) || empty($_POST['psswd']))
{
	header("Location: index.php?err_messg=Please Provide Your Password#intro"); //redirecting to the registration page with a error message
}
else
{
	$psswd=htmlentities($_POST['psswd']);
}

$query ="SELECT te_no,Psswd from users WHERE te_no='".$te_no."'";
	if($query_run = mysqli_query($con,$query))
	{
		$query_num_rows= mysqli_num_rows($query_run);
		if($query_num_rows==0)
		{
				header('Location: index.php?err_messg=Invalid username#intro');
		}
		else if ($query_num_rows==1)
		{
			$ro1=mysqli_fetch_assoc($query_run);
			$password=$ro1['Psswd'];
			if(password_verify('".$psswd."',$password))
			{
				$_SESSION['te_no']=$te_no;
				header('Location: quiz/index.php');
			}
			else
			{
				header('Location: index.php?err_messg=Invalid password#intro');
			}
		}
	}
	else
	{
		die("Could not process login request.");
	}
?>