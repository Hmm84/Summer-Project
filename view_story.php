<?php
include("include/init.php"); 
$storyId = $_REQUEST['storyId']; 
$story = getStory($storyId); 

echo "
    <!DOCTYPE html
    <head>
        <meta charset='utf-8'>
        <link rel='stylesheet' href='style.css'> 
    </head>
    
    <body>
        <div class='grid-container'>"; 
         echo "<div href='view_story.php?storyId=".$story['storyId']."'> ".$story['title']."</div>
         <div style= 'font-size:19px'>".$story['description']."</div> </div>
         <a href='view_chapter.php?storyId=".$story['storyId']."'> Read This story</a> <br>
         <a href='index.php'> Go back </a>"; 

    echo "
        </div>
    </body>"; 