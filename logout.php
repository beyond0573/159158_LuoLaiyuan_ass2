<?php
	session_start();    //session start
	session_unset();    //session release
	session_destroy();  //session delete
	echo "<script> window.location.href ='index.php'</script>";
?>