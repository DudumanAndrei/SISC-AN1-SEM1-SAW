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
	<title>SAW Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/swiper.min.css">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,700,900" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
    <h3 class="my-5">Salut, <b><?php echo htmlspecialchars($_SESSION["nume_utilizator"]); ?></b>. Bine ati venit in partea de backend a site-ului nostru.<br>
        <a href="index.php" class="btn btn-outline-primary btn-sm">Acasa</a>
	    <a href="reset-password.php" class="btn btn-outline-warning btn-sm">Resetati parola</a>
        <a href="logout.php" class="btn btn-outline-danger btn-sm">Iesiti din cont</a>
    </h3>
	<hr/>
	
	<div class="row mx-sm-0 justify-content-center">
		<div class="col-sm-12 col-md-8">
			<div class="contact-form">
				<form id="login-form" action="backend.php" method="get">
					<input type="hidden" name="form-name" value="login-form">
					<div class="row mx-sm-0">
						<div class="form-group col-md-12">
							Cauta utilizator dupa nume: 
							<input type="text" name="nume_utilizator" class="form-control" placeholder="Nume utilizator">
						</div>
						<div class="col-md-12 text-center">
							<div>
								<input type="submit" value="Cauta" name="submit" title="Cauta">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<hr/>
	
	
	</table> 	
	</div>
</body>
</html>