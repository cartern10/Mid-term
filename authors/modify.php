<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged']!=true){
    echo("Sorry you need to be logged in to create an author.");
    echo("<br>");
    echo '<p><a href="../auth/signin.php">Signin Page</a></p>';
    die();
}

if(count($_POST)>0){
    if(file_exists('../Data/authors.csv')){
        $line_counter = 0;
        $new_file_content='';
        $fh=fopen('../Data/authors.csv','r');
        while($line=fgets($fh)){
            if($line_counter==$_GET['index']) $new_file_content.=$_POST['name'].PHP_EOL;
            else $new_file_content.=$line;
            $line_counter++;
        }
        fclose($fh);
    
        file_put_contents('../Data/authors.csv',$new_file_content);
        echo ' You modified an author';
    }
}
else{
    $author_name='';
    $line_counter=0;
    $fh=fopen('../Data/authors.csv','r');
    while($line=fgets($fh)){
        if($line_counter==$_GET['index']){
        //display author
        $author_name=trim($line);
        }
        $line_counter++;
    }
    fclose($fh);

    ?>
    <form method="POST">
        Modify author's name<br />
        <input type="text" name="name" value="<?=$author_name?>" /><br/>
        <button type="submit">Modify Author </button>
    </form>
    <?php
}