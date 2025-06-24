<?php
include("include/init.php"); 
$storyId = $_REQUEST['storyId']; 
$story = getStory($storyId); 

echo "
    <!DOCTYPE html
    <head>
        <meta charset='utf-8'>

        <style>
            .grid-container {
                display: grid;
                grid-template-columns: auto auto auto auto;
                gap: 10px;
                background-color: #d5c2ec;
                padding: 10px;
            }
            .grid-container > div {
                background-color: #f1f1f1;
                color: #000;
                padding: 10px;
                font-size: 30px;
                text-align: center;
            }
        </style>
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