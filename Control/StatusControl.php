<?php
	session_start();
	$userid = $_SESSION['userid'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$DBS = "vms system";
	$port = 3306;

	$con = mysqli_connect($servername, $username, $password, $DBS, $port);
	if(!$con)
	{
		die("Connection Failed : ".$con->connect_error);
		header("Location:../View/Login.php");
	}
	$sql = "SELECT * FROM license WHERE id= ?";
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s",$userid);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$state = $row["status"];
	echo $state;
	/*$data = array();
	if (mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result)) 
		{
			array_push($data, $row);
		}
		echo json_encode($data);
		mysqli_close($con);
		$stmt->close();
		exit();
	}
	else
	{
		header("Location:../Model/Users/Driver.php");
	}*/
	mysqli_close($con);
	$stmt->close();

?>