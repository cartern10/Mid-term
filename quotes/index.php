<a href="create.php"> Add a new quote</a>
<br>
<a href="../authors/create.php"> Add an Author</a>

<?php
include 'csv_util.php';
$author_array = read_authors();

$fh=fopen('../data/quotes.csv','r');
$index=0;
while ($data = fgetcsv($fh, 1000, ";")) {
    $array = $data;
    if(isset($array[1])){
        echo '<h1><a href="detail.php?index='.$index.'">'.$array[1].'</a> - '.$author_array[$array[0]].'</h1>';
    }
    $index++;
}
fclose($fh);