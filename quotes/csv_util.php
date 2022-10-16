<?php
function read_authors(){ //reads authors.csv and passes an array of the authors in the return statement
    $index=0;
    $fh=fopen('../data/authors.csv','r');
    while ($line=fgets($fh)) {
        $author_array[$index] = trim($line);
        $index++;
    }   
    fclose($fh);
    return $author_array;
}

function add_content($author,$quotes){ //adds the quote the user enters and connects it to the author the user selected
    $fh=fopen('../Data/quotes.csv','a');
    fputs($fh,$author.';');
    fputs($fh,$quotes.PHP_EOL);
    fclose($fh);
}

function mod_content($index,$array_value,$author_array,$quote){
    $line_counter = 0;
    $new_file_content='';
    $fh=fopen('../Data/quotes.csv','r');
    while($line=fgets($fh)){
        if($line_counter==$index){
            $author_number=array_search($author_array[$array_value],$author_array);
            $new_file_content.=$author_number.';'.$quote.PHP_EOL;
        }
        else
            $new_file_content.=$line;
        $line_counter++;
    }
    fclose($fh);
    file_put_contents('../Data/quotes.csv',$new_file_content);

}

function button_delete($index){ //deletes line from quotes.php
    if(file_exists('../Data/quotes.csv')){
        $line_counter = 0;
        $new_file_content='';
        $fh=fopen('../Data/quotes.csv','r');
        while($line=fgets($fh)){
            if($line_counter==$index)
                $new_file_content.=PHP_EOL;
            else
                $new_file_content.=$line;
            $line_counter++;
        }
        fclose($fh);
        echo ' You deleted an author';
        ?>
        </br>
        <a href="index.php"> Go back to Index </a>
        <?php
        file_put_contents('../Data/quotes.csv',$new_file_content);
        die();
    }
}

function button_nevermind(){ //user decided not to delete quote, shows a link back to index.php
    echo 'Thanks for not deleting the quote!';?>
    </br>
    <a href="index.php"> Go back to Index </a><?php
    die();
}

