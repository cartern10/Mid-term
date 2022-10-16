<?php

// add parameters
function signup($post){
	// add the body of the function based on the guidelines of signup.php
	if(!isset($post['email'])) 
		die('please enter your email');
	if(!isset($post['password']))
		die('please enter your password');
	if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
		die('Your email is invalid');
	if(strlen($post['password'])<8)
		die('Please enter a password >=8 characters');
	if(file_exists('../data/banned.csv.php')){
		$fh=fopen('../data/banned.csv.php','r');
		while($line=fgets($fh)){
			$line=trim($line);
			if($line==$post['email'])
				die('You are Banned from accessing this site');
		}
		fclose($fh);
	}
	if(file_exists('../data/users.csv.php')){
		$fh=fopen('../data/users.csv.php','r');
		while($line=fgets($fh)){
			$line=trim($line);
			$line=explode(';',$line);
			if($line[0]==$post['email'])
				die('You already have an account');
		}
		fclose($fh);
	}
	$fh=fopen('../data/users.csv.php','a+');
	fputs($fh,$post['email'].';'.password_hash($post['password'],PASSWORD_DEFAULT).PHP_EOL);
	fclose($fh);
	echo('You created your account');
	echo '<p><a href="../signin.php">Sign In</a></p>';
	die();
	
}

// add parameters
function signin($post){
	// add the body of the function based on the guidelines of signin.php
	$fh=fopen('../data/banned.csv.php','r');
	while($line=fgets($fh)){
		$line=trim($line);
		$line=explode(';',$line);
		if($line[0]==$post['email'])
				die('Sorry, you have been banned');
	}
	fclose($fh);

	$fh=fopen('../data/users.csv.php','r');
	while($line=fgets($fh)){
		$line=trim($line);
		$line=explode(';',$line);
		if($line[0]==$post['email']){
			if(password_verify($post['password'],$line[1])){
				$_SESSION['logged']=true;
				$_SESSION['email']=$line[0];
				header('location: ../quotes/index.php');
			}else die('Not today: incorrect password');
		}
	}
	fclose($fh);
	die('Not today: you must create an account first');
}
	

function signout(){
	// add the body of the function based on the guidelines of signout.php
	$_SESSION['logged']=false;
	$_SESSION['email']='';
	session_destroy();
	
	
}

function is_logged(){
	if(isset($_SESSION['logged']) && $_SESSION['logged']==true)
		header('location: ../quotes/index.php');
	// check if the user is logged
	//return true|false
}