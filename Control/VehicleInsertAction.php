<?php	
session_start();
$email2 = $_SESSION['userid'];
$vtype = $_REQUEST['vtype'];
$vnum = $_REQUEST['vnum'];
$servername = "localhost";
$username = "root";
$password = "";
$DBS = "vms system";
$port = 3306; 
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if((empty($vtype)) and (empty($vnum)))
	{
		$_SESSION['error51']="*Please select vehicle type";
		$_SESSION['error52']="*Please enter vehicle number";
		header("Location:../View/VehicleInsert.php");
	}
	elseif((empty($vtype)))
	{
		$_SESSION['error51']="*Please select vehicle type";
		header("Location:../View/VehicleInsert.php");
	}
	elseif((empty($vnum)))
	{
		$_SESSION['error52']="*Please enter vehicle number";
		header("Location:../View/VehicleInsert.php");
	}
	else
	{
		$con = mysqli_connect($servername, $username, $password, $DBS, $port);
		if(!$con)
		{
			die("Connection Failed : ".$con->connect_error);
			header("Location:../View/Login.php");
		}
		$sql = "SELECT * FROM vehicle WHERE vnumber = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("s",$vnum);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		if(mysqli_num_rows($result) < 1)
		{
			$sql1 = "INSERT INTO vehicle (id, vnumber, type) VALUES (?,?,?)";
			$stmt = $con->prepare($sql1);
			$stmt->bind_param("sss",$email2,$vnum,$vtype);
			if($stmt->execute())
			{
				$sql2 = "INSERT INTO notification (msg) VALUES ('New Vehicle[NO : $vnum] Inserted Please Check!!')";
				$stmt = $con->prepare($sql2);
				$stmt->execute();
				header("Location:../Model/Users/General.php");
			}
		}
		else
		{
			$_SESSION['error52']="*Duplicate Vehicle Number";
			header("Location:../View/VehicleInsert.php");
		}
	}
}
else
{
	header("Location:../View/Login.php");
}
?>
