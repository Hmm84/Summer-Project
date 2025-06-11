<?php
include("Include/init.php");
$storyId = $_REQUEST["storyId"];
$chapter = getFirstChapter($storyId);
$choices = getChoices($chapter['chapterId']); 


echo "
    <!DOCTYPE html
    <head>
        <meta charset='utf-8'>

        <style>
            .grid-container {
                display: grid;
                grid-template-row: auto auto auto auto;
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
            // opening to the first chapter of each story 
            echo "<div href='viewPost.php?chapterId=".$chapter['chapterId']."'> ".$chapter['title']."</div>
            <div style= 'font-size:19px'>".$chapter['text']."</div> </div>"; 

            foreach($choices as $index => $choice){
               echo" <div><a href='read_choices.php?to_chapter_id=".htmlspecialchars($choice['to_chapter_id'])."'>".$choice['choiceText']."</a></div>"; 
            }
    echo "
        </div>
    </body>"; 