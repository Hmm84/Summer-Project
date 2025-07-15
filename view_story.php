<?php
include("include/init.php"); 
$storyId = $_REQUEST['storyId']; 
$story = getStory($storyId); 

echo "
    <!DOCTYPE html
    <head>
        <meta charset='utf-8'>
        <link rel='stylesheet' href='book.css'> 

    </head>
    
    <body>
        <div class='book'>
        
            <div class='left-page'; href='view_story.php?storyId=".$story['storyId']."'> 
                <h2>".$story['title']."</h2>
                <p>".$story['description']."</p> 
            </div>

            <div class='right-page'>
                <a class='choice'; href='view_chapter.php?storyId=".$story['storyId']."'> Read This story</a> <br>
                <a class ='choice'; href='library_page.php'> Go back </a>
            </div>
        </div>
    </body>"; 