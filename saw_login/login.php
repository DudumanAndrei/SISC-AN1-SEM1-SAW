<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: backend.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nume_utilizator = $parola = "";
$nume_utilizator_err = $parola_err = $login_err = "";
 
// Processing form data when form is submitted
#echo('<script>console.log("start")</script>');
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    // Check if nume_utilizator is empty
    if(empty(trim($_POST["nume_utilizator"])))
	{
        $nume_utilizator_err = "Va rog introduceti numele utilizatorului.";
    } 
	else
	{
        $nume_utilizator = trim($_POST["nume_utilizator"]);
    }
    
    // Check if parola is empty
    if(empty(trim($_POST["parola"])))
	{
        $parola_err = "Va rog sa va introduceti parola.";
    } 
	else
	{
        $parola = trim($_POST["parola"]);
    }
    
    // Validate credentials
    if(empty($nume_utilizator_err) && empty($parola_err))
	{
        // Prepare a select statement
        $sql = "SELECT id, nume_utilizator, parola FROM utilizatori WHERE nume_utilizator = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
		{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_nume_utilizator);
            
            // Set parameters
            $param_nume_utilizator = $nume_utilizator;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if nume_utilizator exists, if yes then verify parola
                if(mysqli_stmt_num_rows($stmt) == 1)
				{                   
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $nume_utilizator, $hashed_parola);
                    if(mysqli_stmt_fetch($stmt))
					{
                        if(password_verify($parola, $hashed_parola))
						{
                            // parola is correct, so start a new session
							if(!isset($_SESSION))
							{ 
								session_start();
							}
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["nume_utilizator"] = $nume_utilizator;                            
                            
                            // Redirect user to welcome page
                            header("location: backend.php");
                        } 
						else
						{
                            // parola is not valid, display a generic error message
                            $login_err = "Nume utilizator sau parola invalide.";
                        }
                    }
                } 
				else
				{
                    // nume_utilizator doesn't exist, display a generic error message
                    $login_err = "Nume utilizator sau parola invalide.";
                }
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
	<title>Master SISC Laborator SAW</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/swiper.min.css">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,700,900" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
	<section id="autentificare" class="contact">
		<div class="container">
			<h1>AUTENTIFICARE</h1>
			<a href="index.php" class="btn btn-outline-primary btn-sm">Acasa</a>
			<hr class="about-line">
			<?php 
			if(!empty($login_err))
			{
				echo '<div class="alert alert-danger">' . $login_err . '</div>';
			}        
			?>
			<div class="row mx-sm-0 justify-content-center">
				<div class="col-sm-12 col-md-8">
					<div class="contact-form">
						<form id="login-form" action="login.php" method="post">
							<input type="hidden" name="form-name" value="login-form">
							<div class="row mx-sm-0">
								<div class="form-group col-md-12">
									Nume utilizator: 
									<input type="text" name="nume_utilizator" class="form-control" placeholder="Nume utilizator" required="required">
									Parola: 
									<input type="password" name="parola" class="form-control" placeholder="Parola" required="required">
									<span class="invalid-feedback"><?php echo $parola_err; ?></span>
								</div>
								<div class="col-md-12 text-center">
									<div>
										<input type="submit" value="Autentificare" name="submit" title="Autentificare">
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