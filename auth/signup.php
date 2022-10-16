<?php
include 'auth.php';
session_start();
// if the user is alreay signed in, redirect them to the members_page.php page
is_logged();
// use the following guidelines to create the function in auth.php
// instead of using "die", return a message that can be printed in the HTML page
if(count($_POST)>0){
	signup($_POST);
}
	// check if the email is valid
	// check if password length is between 8 and 16 characters
	// check if the password contains at least 2 special characters
	// check if the file containing banned users exists
	// check if the email has not been banned
	// check if the file containing users exists
	// check if the email is in the database already
	// encrypt password
	// save the user in the database 
	// show them a success message and redirect them to the sign in page
// improve the form
?>
Create an Account:
<form method="POST">
	Email:
	<input type="email" name="email" />
	<br>
	Password:
	<input type="password" name="password"/>
	<br>
	<input type="submit" value="submit" />
</form>
<br>
Already have an Account?
<a href="signin.php">Sign in to an Account!</a>
