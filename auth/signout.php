<?php
include 'auth.php';
session_start();
// if the user is not logged in, redirect them to the public page
if(!isset($_SESSION['logged']) || $_SESSION['logged']!=true)
	header('location: ../quotes/index.php');
else
	signout();
	header('location: ../quotes/index.php');


// use the following guidelines to create the function in auth.php
// redirect the user to the public page.