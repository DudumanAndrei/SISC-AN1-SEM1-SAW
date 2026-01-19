
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hostel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/swiper.min.css">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,700,900" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
    <div class="container">

<?php
	require_once "config.php";

	//---------------------------------------------------------------------------------------------
	//print_r($_POST);
	if(isset($_POST["tourist_name"]) && isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["message"]))
	{
		$fields="";
		$values="";
		if(isset($_POST["tourist_name"]))
		{
			$fields.="tourist_name";
			$values.='"'.mysqli_real_escape_string($connection,$_POST["tourist_name"]).'"';
		}
		if(isset($_POST["email"]))
		{
			$fields.=",email";
			$values.=',"'.mysqli_real_escape_string($connection,$_POST["email"]).'"';
		}
		if(isset($_POST["subject"]))
		{ 
			$fields.=",subject";
			$values.=',"'.mysqli_real_escape_string($connection,$_POST["subject"]).'"';
		}
		if(isset($_POST["message"]))
		{ 
			$fields.=",message";
			$values.=',"'.mysqli_real_escape_string($connection,$_POST["message"]).'"';
		}
		//echo $values;
		
		$query="INSERT INTO reservations(".$fields.") VALUES (".$values.")";		
		$result=$connection->query($query);
		
		if($result)
		{
			echo '<p>The reservation was successfully added.</p>';
			echo '<a href="index.html" class="btn btn-outline-primary btn-sm">Home</a>';
		}
		else
		{
			echo '<p>The reservations was not added. Please try again later.</p>';
			echo '<a href="index.html" class="btn btn-outline-primary btn-sm">Home</a>';
			//echo mysqli_error($connection);
		}
	}	
	//---------------------------------------------------------------------------------------------
	
	$connection->close();
?>

	</div>
</body>
