<?php
$mysql_host='localhost';
$mysql_user='root';
$mysql_pass='';
$mysql_database="quinthurdle";
$conn_error="Couldn't Connect to the database";




// connecting the database
if(!$con=mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_database))
{
	die($conn_error);
}
?>