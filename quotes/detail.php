<p><a href="index.php">Index Page</a></p>
<hr/>

<?php
include 'csv_util.php';

$index=0;
$author_array = read_authors();
$line_counter=0;
$fh=fopen("../data/quotes.csv", "r");
while ($data = fgetcsv($fh, 1000, ";")) {
    $array = $data;
    if($line_counter==$_GET['index']) {
        echo '<h1 style="font-size:50">'.$array[1].' - '.$author_array[$array[0]]. '</h1>';
    }
    $line_counter++;
}
fclose($fh);

?>
(<a href="modify.php?index=<?=$_GET['index']?>"> modify quote </a>)
(<a href="delete.php?index=<?=$_GET['index']?>"> delete quote </a>)