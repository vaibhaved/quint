<?php

include_once 'sql.php';

// fetching and validating the enrollment no
if(!isset($_POST['te_no']) || empty($_POST['te_no']))
{
	header("Location: index.php?err_messg_sign=The Team Name can't be left blank#work"); //redirecting to the registration page with a error message
}

// Assigning the value to the Er_no
if(isset($_POST['te_no']) && !empty($_POST['te_no']) )
{
	$te_no=htmlentities(strtolower($_POST['te_no']));
}
else
{
	header("location: index.php?err_messg_sign=Invalid Team Name#work");
}

// fetching and validating the enrollment no
if(!isset($_POST['er_no1']) || empty($_POST['er_no1']))
{
	header("Location: index.php?err_messg_sign=The enrollment number can't be left blank#work"); //redirecting to the registration page with a error message
}

// Assigning the value to the Er_no
if(isset($_POST['er_no1']) && !empty($_POST['er_no1']) )
{
	$er_no1=htmlentities(strtolower($_POST['er_no1']));
}
else
{
	header("location: index.php?err_messg_sign=Invalid Enrollment Number#work");
}

// fetching and validating the enrollment no
if(!isset($_POST['er_no2']) || empty($_POST['er_no2']))
{
	header("Location: index.php?err_messg_sign=The enrollment number can't be left blank#work"); //redirecting to the registration page with a error message
}

// Assigning the value to the Er_no
if(isset($_POST['er_no2']) && !empty($_POST['er_no2']) )
{
	$er_no2=htmlentities(strtolower($_POST['er_no2']));
}
else
{
	header("location: index.php?err_messg_sign=Invalid Enrollment Number#work");
}

// fetching and validating the enrollment no
if(!isset($_POST['er_no3']) || empty($_POST['er_no3']))
{
	header("Location: index.php?err_messg_sign=The enrollment number can't be left blank#work"); //redirecting to the registration page with a error message
}

// Assigning the value to the Er_no
if(isset($_POST['er_no3']) && !empty($_POST['er_no3']) )
{
	$er_no3=htmlentities(strtolower($_POST['er_no3']));
}
else
{
	header("location: index.php?err_messg_sign=Invalid Enrollment Number#work");
}




// fetching and validating First Name and last name
if(!isset($_POST['f_name1']) || !isset($_POST['f_name2']) || !isset($_POST['f_name3']) || empty($_POST['f_name1']) || empty($_POST['f_name2']) || empty($_POST['f_name3']))
{
	header("location: index.php?err_messg_sign=The name releated fields couldn't be left blank!#work");
}



// Assigning the value to First name and the last name
if(isset($_POST['f_name1']) && !empty($_POST['f_name1']) && isset($_POST['f_name2'])&& !empty($_POST['f_name2']) && isset($_POST['f_name3'])&& !empty($_POST['f_name3']) && strlen($_POST['f_name1'])<=20 && strlen($_POST['f_name2'])<=20 && strlen($_POST['f_name3'])<=20 )
{
	$f_name1=htmlentities(strtoupper($_POST['f_name1']));
	$f_name2=htmlentities(strtoupper($_POST['f_name2']));
	$f_name3=htmlentities(strtoupper($_POST['f_name3']));
}
else
{
	header("Location: index.php?err_messg_sign=Invalid Name Entries!!");
}

// Fetching and validating the E-mail Address
if(!isset($_POST['e_mail']) && empty($_POST['e_mail']))
{
	header("location: index.php?err_messg_sign=E-mail Field could not be left blank#work"); //redirecting to the registration page with a error message
}
else
{
	$email=htmlentities($_POST['e_mail']);
}
 
//Assigning and fetching the Phone Number
if(!isset($_POST['ph_no']) || empty($_POST['ph_no']))
{
	header("location: index.php?err_messg_sign=Please provide with phone number#work"); //redirecting to the registration page with a error message
}


//Validating the Phone Number
if(isset($_POST['ph_no']) && !empty($_POST['ph_no']) && is_numeric($_POST['ph_no']))
{
	$ph_no=htmlentities(strtolower($_POST['ph_no']));
}
else
{
	header("location: index.php?err_messg_sign=Invalid Phone Number#work");
}


//Assigning and fetching the Password
if(!isset($_POST['psswd']) || empty($_POST['psswd']))
{
	header("Location: index.php?err_messg_sign=Password field could not be left blank#work"); //redirecting to the registration page with a error message
}
else
{
	$psswd=htmlentities($_POST['psswd']);
	$psswd=password_hash('".$psswd."',PASSWORD_DEFAULT);
}


//Fetching the ip address
function get_ip_address()
{
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$ip_addr=get_ip_address();



//Assigning score 0 at the time of the new registaraion
$score = 0;


//Creating the Userid
$userid='QHU'.rand(100,999).substr($te_no,-3);


//Sql Query 
if(!empty($te_no)&&!empty($er_no1)&&!empty($er_no2)&&!empty($er_no3)&&!empty($f_name1)&&!empty($f_name2)&&!empty($f_name3)&& !empty($email) && !empty($ph_no) && !empty($psswd))
{
	$query="INSERT INTO users (te_no, er_no1, er_no2, er_no3, f_name1, f_name2, f_name3 ,e_mail,ph_no,psswd,ip_addr,score,user_id,time) VALUES ('".$te_no."','".$er_no1."','".$er_no2."','".$er_no3."','".$f_name1."','".$f_name2."','".$f_name3."','".$email."','".$ph_no."','".$psswd."','".$ip_addr."','".$score."','".$userid."',NOW())";
	if(mysqli_query($con,$query))
	{
		include_once 'core.inc.php';
		
		$_SESSION['te_no']=$te_no;
		header("Location: quiz/index.php");
	}
	else
	{
		header('Location: index.php?err_messg_sign=Already a player with the user id#work');
	}
}
else
{
	header('Location: index.php?err_messg_sign=All fields are mandatory#work');
}
?>