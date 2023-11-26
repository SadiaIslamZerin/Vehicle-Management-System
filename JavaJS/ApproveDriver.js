function isAccept(StatusBar)
{
	let str = StatusBar.search001.value;
	if (StatusBar.search001.value === "")
	{
		document.getElementById("delete04").innerHTML = "Please Enter User ID";
		return false;
	}
	else
	{
		const xvalue = new XMLHttpRequest();
		xvalue.onload = function() 
		{
			
		};
		xvalue.open("GET", "../Control/ApproveDriver.php?q="+str);
		xvalue.send();
	}
}