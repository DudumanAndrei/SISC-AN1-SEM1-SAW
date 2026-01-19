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
$user_name = $password = "";
$user_name_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    // Check if user_name is empty
    if(empty(trim($_POST["user_name"])))
	{
        $user_name_err = "Please enter a user name.";
    } 
	else
	{
        $user_name = trim($_POST["user_name"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"])))
	{
        $password_err = "Please enter a password.";
    } 
	else
	{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($user_name_err) && empty($password_err))
	{
        // Prepare a select statement
        $sql = "SELECT id, user_name, password FROM employees WHERE user_name = ?";
        
        if($stmt = mysqli_prepare($connection, $sql))
		{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_user_name);
            
            // Set parameters
            $param_user_name = $user_name;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if user_name exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1)
				{                   
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $user_name, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
					{
                        if(password_verify($password, $hashed_password))
						{
                            // password is correct, so start a new session
							if(!isset($_SESSION))
							{ 
								session_start();
							}
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["user_name"] = $user_name;                            
                            
                            // Redirect user_name to welcome page
                            header("location: backend.php");
                        } 
						else
						{
                            // password is not valid, display a generic error message
                            $login_err = "Invalid username, password combination.";
                        }
                    }
                } 
				else
				{
                    // user_name doesn't exist, display a generic error message
                    $login_err = "Invalid username, password combination.";
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
	<section id="authentication" class="contact">
		<div class="container">
			<h1>Employees Login</h1>
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
									User name: 
									<input type="text" name="user_name" class="form-control" placeholder="User name" required="required">
									Password: 
									<input type="password" name="password" class="form-control" placeholder="Password" required="required">
									<span class="invalid-feedback"><?php echo $password_err; ?></span>
								</div>
								<div class="col-md-12 text-center">
									<div>
										<input type="submit" value="Login" name="submit" title="Login">
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
