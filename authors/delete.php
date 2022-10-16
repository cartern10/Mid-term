<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged']!=true){
    echo("Sorry you need to be logged in to create an author.");
    echo("<br>");
    echo '<p><a href="../auth/signin.php">Signin Page</a></p>';
    die();
}

if(!isset($_GET['index'])){
    die("Please enter the author you want to delete");
}

if(file_exists('../Data/authors.csv')){
    $line_counter = 0;
    $new_file_content='';
    $fh=fopen('../Data/authors.csv','r');
    while($line=fgets($fh)){
        if($line_counter==$_GET['index']) $new_file_content.=PHP_EOL;
        else $new_file_content.=$line;
        $line_counter++;
    }
    fclose($fh);
    file_put_contents('../Data/authors.csv',$new_file_content);
    echo ' You deleted an author';
    
}
?>
</br>
<a href="index.php"> Index Page </a>
