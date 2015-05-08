<?php
	$server = 'localhost';			
	$username = 'root';
	$password = '123456';
	$database = 'a119';
					
	$mycon = mysql_connect( $server, $username, $password ) or die( "MySQL connection error" );
	$sql = "CREATE DATABASE IF NOT EXISTS a119";
	$result = mysql_query($sql, $mycon) or die('Error: ' . mysql_error());
	mysql_select_db ($database, $mycon);
	mysql_query("set names gb2312") or die('Error: ' . mysql_error());
?>