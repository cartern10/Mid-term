<?php
include 'csv_util.php';
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged']!=true){
    echo("Sorry you need to be logged in to delete a quote.");
    echo("<br>");
    echo '<p><a href="../auth/signin.php">Signin Page</a></p>';
    die();
}
if(array_key_exists('button_delete', $_POST)) {
    button_delete($_GET['index']);
}
if(array_key_exists('button_nevermind', $_POST)) {
    button_nevermind();
}



?>
<form method="post">
    <input type="submit" name='button_delete' class="button" value="DELETE"/>
    <input type="submit" name='button_nevermind' class="button" value="Nevermind"/>
    
</form>

</br>
<a href="create.php"> Add a new quote </a>
