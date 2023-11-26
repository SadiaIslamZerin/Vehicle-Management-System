<?php
	session_start();
	$complaint = $_REQUEST['complaint'];
	echo $complaint;
	echo "<br>"."</br>";
	echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";
?>