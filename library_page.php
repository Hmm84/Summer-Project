<?php
include("include/init.php"); 
$stories = getAllStories();

echo "
    <!DOCTYPE html
    <head>
        <meta charset='utf-8'>
        <link rel='stylesheet' href='style.css'> 
    </head>
    
    <body>
        <div class='grid-container'>"; 

        foreach($stories as $story){
            echo "<div><a href='view_story.php?storyId=$story[storyId]'>$story[title]</a></div>"; 
        }

    echo "
        </div>
    </body>"; 