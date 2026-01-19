<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$parola_noua = $parola_confirmata = "";
$parola_noua_err = $parola_confirmata_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    // Validate new password
    if(empty(trim($_POST["parola_noua"])))
	{
        $parola_noua_err = "Va rog sa introduceti noua parola.";
    } 
	elseif(strlen(trim($_POST["parola_noua"])) < 6)
	{
        $parola_noua_err = "Parola trebuie sa aibe cel putin 6 caractere";
    } 
	else
	{
        $parola_noua = trim($_POST["parola_noua"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["parola_confirmata"])))
	{
        $parola_confirmata_err = "Va rog sa confirmati parola.";
    } 
	else
	{
        $parola_confirmata = trim($_POST["parola_confirmata"]);
        if(empty($parola_noua_err) && ($parola_noua != $parola_confirmata))
		{
            $parola_confirmata_err = "Parolele nu sunt egale.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($parola_noua_err) && empty($parola_confirmata_err))
	{
        // Prepare an update statement
        $sql = "UPDATE utilizatori SET parola = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
		{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($parola_noua, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } 
			else
			{
                echo "Eroare. Va rog sa incercari mai tarziu.";
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
	<div class="container">
    <h3 class="my-5">
		Utilizator: <?php echo htmlspecialchars($_SESSION["nume_utilizator"]); ?>
        <a href="index.php" class="btn btn-outline-primary btn-sm">Acasa</a>
        <a href="logout.php" class="btn btn-outline-danger btn-sm">Iesiti din cont</a>
	</h3>
	</div>

	<section id="autentificare" class="contact">
		<div class="container">
			<h1>Resetare parola</h1>
			<hr class="about-line">
			<div class="row mx-sm-0 justify-content-center">
				<div class="col-sm-12 col-md-8">
					<div class="contact-form">
						<form id="login-form" action="login.php" method="post">
							<input type="hidden" name="form-name" value="login-form">
							<div class="row mx-sm-0">
								<div class="form-group col-md-12">
									Parola noua: 
									<input type="password" name="parola_noua" class="form-control" placeholder="Parola noua" required="required" value="<?php echo $parola_noua; ?>">
									Confirmati parola: 
									<input type="password" name="parola_confirmata" class="form-control" placeholder="Parola confirmata" required="required">
								</div>
								<div class="col-md-12 text-center">
									<div>
										<input type="submit" value="Confirmare" name="submit" title="Confirmare">
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