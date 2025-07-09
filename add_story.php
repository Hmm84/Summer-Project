<?php
include("Include/init.php"); 
$stories = getAllStories(); 

echo "<!DOCTYPE html>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta charset='utf-8'>
        <link rel='stylesheet' href='library.css'> 
        <link rel='stylesheet' href='book.css'> 
    </head>

    <body style='background-color: white'>
";

foreach($stories as $story){
    echo "<a href='flow_chart.php?storyId=" .$story['storyId']. "'>" .$story['title']. "</a>"; 
}



echo "
</body>
</html>"; 
