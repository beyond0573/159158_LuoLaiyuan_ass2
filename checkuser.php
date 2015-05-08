<?php
	//session_start();
	include "conn.php";
	//check whether username has been used
	$username = $_GET['userName'];
	$query = "select id from tb_users where name = '".$username."'";
	$result = mysql_query($query, $mycon) or die('Error: ' . mysql_error());
    $num = mysql_num_rows($result); 
    echo $num; 
?>