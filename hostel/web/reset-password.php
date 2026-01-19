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
$new_password = $confirmed_password = "";
$new_password_err = $confirmed_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    // Validate new password
    if(empty(trim($_POST["new_password"])))
	{
        $new_password_err = "Please enter a new password.";
    } 
	elseif(strlen(trim($_POST["new_password"])) < 6)
	{
        $new_password_err = "The password must have at least 6 characters.";
    } 
	else
	{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirmed_password"])))
	{
        $confirmed_password_err = "Please confirm the password.";
    } 
	else
	{
        $confirmed_password = trim($_POST["confirmed_password"]);
        if(empty($new_password_err) && ($new_password != $confirmed_password))
		{
            $confirmed_password_err = "Passwords are not equal.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirmed_password_err))
	{
        // Prepare an update statement
        $sql = "UPDATE employees SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($connection, $sql))
		{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
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
                echo "Error. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }    
    // Close connection
    mysqli_close($connection);
}
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
    <h3 class="my-5">
		User: <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
        <a href="index.html" class="btn btn-outline-primary btn-sm">Home</a>
        <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
	</h3>
	</div>

	<section id="reset-password" class="contact">
		<div class="container">
			<h1>Reset passsword</h1>
			<hr class="about-line">
			<div class="row mx-sm-0 justify-content-center">
				<div class="col-sm-12 col-md-8">
					<div class="contact-form">
						<form id="login-form" action="reset-password.php" method="post">
							<input type="hidden" name="form-name" value="login-form">
							<div class="row mx-sm-0">
								<div class="form-group col-md-12">
									New password: 
									<input type="password" name="new_password" class="form-control" placeholder="New password" required="required" value="<?php echo $new_password; ?>">
									<span class="text-danger"><?php echo $new_password_err; ?></span>
									
									Confirmed password: 
									<input type="password" name="confirmed_password" class="form-control" placeholder="Confirmed password" required="required">
									<span class="text-danger"><?php echo $confirmed_password_err; ?></span>
								</div>
								<div class="col-md-12 text-center">
									<div>
										<input type="submit" value="Submit" name="submit" title="Submit">
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
