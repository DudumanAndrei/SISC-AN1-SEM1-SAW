<?php

header("X-XSS-Protection: 0"); 

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";
?>

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
    <h3 class="my-5">Hello, <b><?php echo htmlspecialchars($_SESSION["user_name"]); ?></b>. 
		Welcome to Hostel backend.
        <a href="index.html" class="btn btn-outline-primary btn-sm">Home</a>
	    <a href="reset-password.php" class="btn btn-outline-warning btn-sm">Reset password</a>
        <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
    </h3>
	<hr/>
	
	<div class="row mx-sm-0 justify-content-center">
		<div class="col-sm-12 col-md-8">
			<div class="contact-form">
				<form id="login-form" action="backend.php" method="get">
					<input type="hidden" name="form-name" value="login-form">
					<div class="row mx-sm-0">
						<div class="form-group col-md-12">
							Search tourist by name: 
							<input type="text" name="tourist_name" class="form-control" placeholder="Tourist name">
						</div>
						<div class="col-md-12 text-center">
							<div>
								<input type="submit" value="Search" name="submit" title="Search">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<hr/>
	
	<?php
	$query = "SELECT id,tourist_name,email,subject,message,timestamp FROM reservations";
	$tourist_name = "";
	if($stmt = mysqli_prepare($connection, $query))
	{
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{ 
			if(isset($_GET["tourist_name"]) && !empty(trim($_GET["tourist_name"])))
			{
				$tourist_name = $_GET["tourist_name"];
				//$tourist_name = mysqli_real_escape_string($connection,$tourist_name);
				$query = "SELECT id,tourist_name,email,subject,message,timestamp FROM reservations WHERE tourist_name LIKE '%".$tourist_name."%'";
			}
		}
		
		#echo $query."<br>";
		#echo $tourist_name."<br>";
		
		$result = mysqli_query($connection, $query);
		$rowcount=mysqli_num_rows($result);
		
		if($rowcount==0)
		{
			echo "<p>No records found for <b>".$tourist_name."</b>.</p>";
		}
		else
		{
			if(!empty($tourist_name))
			{
				echo "<p> The results for the search of <b>".$tourist_name."</b> are:";
			}
			
			echo '
			<table border="1" cellspacing="2" cellpadding="2"> 
				<tr> 
					<td>id</td> 
					<td>tourist name</td> 
					<td>email</td> 
					<td>subject</td> 
					<td>message</td> 
					<td>timestamp</td> 
				</tr>';
			
			while($row = mysqli_fetch_row($result)) 
			{
				//printf("%s %s %s %s %s<br>", $row[0], $row[1], $row[2], $row[3], $row[4]);
				$id=$row[0];
				$tourist_name=$row[1];
				$email=$row[2];
				$subject=$row[3];
				$mesaj=$row[4];
				$timestamp=$row[5];
				echo '<tr> 
					  <td>'.$id.'</td> 
					  <td>'.$tourist_name.'</td> 
					  <td>'.$email.'</td> 
					  <td>'.$subject.'</td> 
					  <td>'.$mesaj.'</td> 
					  <td>'.$timestamp.'</td> 
					  </tr>';				
			}
		}		
		mysqli_stmt_close($stmt);			
	}
	?>
	
	</table> 	
	</div>
</body>
</html>
