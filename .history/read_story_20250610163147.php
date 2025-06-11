<?php
include("Include/init.php"); 
$stories = getAllStories();
$chapters = getAllChapters(); 
$chapter = getChapter($_REQUEST['storyId']); 



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
        foreach($stories as $index => $story){
            
            echo "<div><a href='read_story.php?chapterId=".$chapter['chapterId']."'>".$story['title']."</a>"; 
            echo "<div style= 'font-size:19px'>".$story['description']."</div> </div>"; 
        }

    echo "
        </div>
    </body>"; 
    