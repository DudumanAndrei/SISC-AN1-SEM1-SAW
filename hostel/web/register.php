<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$user_name = $password = $confirmed_password = "";
$user_name_err = $password_err = $confirmed_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validate username
    if(empty(trim($_POST["user_name"])))
	{
        $user_name_err = "Please enter a user name.";
    } 
	elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["user_name"])))
	{
        $user_name_err = "The user name may contain only letters, digits and underscore.";
    } 
	else
	{
        // Prepare a select statement
        $sql = "SELECT id FROM employees WHERE user_name = ?";
        
        if($stmt = mysqli_prepare($connection, $sql))
		{
            // Set parameters
            $param_user_name = trim($_POST["user_name"]);
			
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_user_name);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
                // Store result
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
				{
                    $user_name_err = "This user name is already taken.";
                } 
				else
				{
                    $user_name = trim($_POST["user_name"]);
                }
            } 
			else
			{
                echo "Error. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"])))
	{
        $password_err = "Please enter a password.";
    } 
	elseif(strlen(trim($_POST["password"])) < 6)
	{
        $password_err = "The password must have at least 6 characters.";
    } 
	else
	{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirmed_password"])))
	{
        $confirmed_password_err = "Please confirm the password.";
    } 
	else
	{
        $confirmed_password = trim($_POST["confirmed_password"]);
        if(empty($password_err) && ($password != $confirmed_password))
		{
            $confirmed_password_err = "The passwords are not equal.";
        }
    }
	
    // Check input errors before inserting in database
    if(empty($user_name_err) && empty($password_err) && empty($confirmed_password_err))
	{    
        // Prepare an insert statement
        $sql = "INSERT INTO employees (user_name, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($connection, $sql))
		{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_user_name, $param_password);
            
            // Set parameters
            $param_user_name = $user_name;
			// Creates a password hash
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
                // Redirect to login page
                header("location: login.php");
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
	<section id="inregistrare" class="contact">
		<div class="container">
			<h1>Registration</h1>
			<hr class="about-line">
			<div class="row mx-sm-0 justify-content-center">
				<div class="col-sm-12 col-md-8">
					<div class="contact-form">
						<form id="registration-form" action="register.php" method="post">
							<input type="hidden" name="form-name" value="login-form">
							<div class="row mx-sm-0">
								<div class="form-group col-md-12">
									User name: <input type="text" name="user_name" class="form-control" placeholder="User name" required="required">
									Password: <input type="password" name="password" class="form-control" placeholder="Password" required="required">
									Confirmed password: <input type="password" name="confirmed_password" class="form-control" placeholder="Password" required="required">
								</div>
								<div class="col-md-12 text-center">
									<div>
										<input type="submit" value="Register" name="submit" title="Register">
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
