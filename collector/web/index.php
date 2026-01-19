<?php
	$connection=new mysqli("localhost","root","","collector");

	if($connection->connect_errno)
	{
		echo "Failed to connect to MySQL: " . $connection->connect_error;
		exit();
	}
	else
	{
		//echo "Connection succeeded!";
	}

	//---------------------------------------------------------------------------------------------
	if(isset($_GET["cookie"]))
	{		
		$query="INSERT INTO cookies(value) VALUES (\"".$_GET["cookie"]."\");";
		$result=$connection->query($query);
		#echo $query."<br/>";
		
		if($result)
		{
			echo '{"error":0, "text":"new object '.$_GET["cookie"].' was added"}';
		}
		else
		{
			echo '{"error":1, "text":"'.mysqli_error($connection).'"}';
		}
	}	
	//---------------------------------------------------------------------------------------------
	
	$connection->close();
?>
