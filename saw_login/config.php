<?php
/* Database credentials. Assuming you are running MySQL server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'saw_login');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//include 'ChromePhp.php';
//ChromePhp::log('hello world');
//ChromePhp::log($_SERVER);

/*
// using labels
foreach ($_SERVER as $key => $value) 
{
    ChromePhp::log($key, $value);
}

// warnings and errors
ChromePhp::warn('this is a warning');
ChromePhp::error('this is an error');
*/
?>