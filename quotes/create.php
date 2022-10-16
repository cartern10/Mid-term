<?php
include 'csv_util.php';
session_start();
//WORK ON THIS
print_r($_SESSION);
if(!isset($_SESSION['logged']) || $_SESSION['logged']!=true){
    echo("Sorry you need to be logged in to create a quote.");
    echo("<br>");
    echo '<p><a href="../auth/signin.php">Signin Page</a></p>';
    die();
}

if(count($_POST)>0){
    $error='';
    //make sure name is not already in the file
    if(file_exists('../Data/quotes.csv')){
        $fh=fopen('../Data/quotes.csv','r');
        while($line=fgets($fh)){
            if($_POST['quote']==trim($line))
            $error='The quote already exists'; //quote found already
        }
        fclose($fh);
    }

    if(strlen($error)>0) echo $error;
    else{
        add_content($_POST['author'],$_POST['quote']);
        echo 'Thanks for adding '.$_POST['quote'].' to our amazing website!';
    }
}
?>
<form method="POST">
    Enter Quote and select author name<br />
    <input type="text" name="quote" /><br/>
    
    <label for="author">Choose an author:</label>
    <select name="author" id="author">
        <?php
        if(file_exists('../Data/authors.csv')){
            $fh=fopen('../Data/authors.csv','r');
            $index = 0;
            while($line=fgets($fh)){
                if(strlen(trim($line))>0)
                    echo'<option value="'.$index.'">'.trim($line).'</option>'; //NEEDS NAME OF AUTHOR INSTEAD OF INDEX NUMBER
                $index++;
            }
            fclose($fh);
        }
        ?>
    </select>
    <br>
<button type="submit">Add Quote </button>
</form>
</br>
<a href="index.php"> Index Page </a>