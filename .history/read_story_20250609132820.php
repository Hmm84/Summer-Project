<?php
include("Include/init.php"); 
$stories = getAllStories(); 

echo "
    <!DOCTYPE html
    <head>
        <meta charset='utf-8'>
    </head>
    
    <body>
        <div>"; 
        foreach($stories as $story){
            echo "<div> <a>".$story['title']."</a></div>"; 
        }

    echo "
        </div>
    </body>"; 
    