<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nume_utilizator = $parola = $parola_confirmata = "";
$nume_utilizator_err = $parola_err = $parola_confirmata_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validate username
    if(empty(trim($_POST["nume_utilizator"])))
	{
        $nume_utilizator_err = "Va rog sa introduceti un nume de utilizator.";
    } 
	elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["nume_utilizator"])))
	{
        $nume_utilizator_err = "Numele de utilizator poate contine doar litere, cifre si underscore.";
    } 
	else
	{
        // Prepare a select statement
        $sql = "SELECT id FROM utilizatori WHERE nume_utilizator = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
		{
            // Set parameters
            $param_nume_utilizator = trim($_POST["nume_utilizator"]);
			
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_nume_utilizator);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
                // Store result
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
				{
                    $nume_utilizator_err = "Acest nume de utilizator este luat.";
                } 
				else
				{
                    $nume_utilizator = trim($_POST["nume_utilizator"]);
                }
            } 
			else
			{
                echo "Eroare. Va rugam sa incercati mai tarziu.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["parola"])))
	{
        $parola_err = "Va rog sa introduceti o parola.";
    } 
	elseif(strlen(trim($_POST["parola"])) < 3)
	{
        $parola_err = "Parola trebuie sa aiba cel putin 3 caractere.";
    } 
	else
	{
        $parola = trim($_POST["parola"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["parola_confirmata"])))
	{
        $parola_confirmata_err = "Va rog sa confirmati parola.";
    } 
	else
	{
        $parola_confirmata = trim($_POST["parola_confirmata"]);
        if(empty($parola_err) && ($parola != $parola_confirmata))
		{
            $parola_confirmata_err = "Parolele nu sunt egale.";
        }
    }
	
    // Check input errors before inserting in database
    if(empty($nume_utilizator_err) && empty($parola_err) && empty($parola_confirmata_err))
	{    
        // Prepare an insert statement
        $sql = "INSERT INTO utilizatori (nume_utilizator, parola) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql))
		{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_nume_utilizator, $param_parola);
            
            // Set parameters
            $param_nume_utilizator = $nume_utilizator;
			// Creates a password hash
            $param_parola = password_hash($parola, PASSWORD_DEFAULT); 
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
                // Redirect to login page
                header("location: login.php");
            } 
			else
			{
                echo "Eroare. Va rog sa incercati mai tarziu.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }    
    // Close connection
    mysqli_close($link);
}
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
	<section id="inregistrare" class="contact">
		<div class="container">
			<h1>INREGISTRARE</h1>
			<hr class="about-line">
			<a href="index.php" class="btn btn-outline-primary btn-sm">Acasa</a>
			<div class="row mx-sm-0 justify-content-center">
				<div class="col-sm-12 col-md-8">
					<div class="contact-form">
						<form id="registration-form" action="register.php" method="post">
							<input type="hidden" name="form-name" value="login-form">
							<div class="row mx-sm-0">
								<div class="form-group col-md-12">
									Nume utilizator: <input type="text" name="nume_utilizator" class="form-control" placeholder="Email" required="required">
									Parola: <input type="password" name="parola" class="form-control" placeholder="Parola" required="required">
									Confirmati parola: <input type="password" name="parola_confirmata" class="form-control" placeholder="Parola" required="required">
								</div>
								<div class="col-md-12 text-center">
									<div>
										<input type="submit" value="Inregistrare" name="submit" title="Inregistrati-va">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>