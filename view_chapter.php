<?php
include("include/init.php");
if(!empty($_REQUEST["toChapterId"])){
    $chapterId = $_REQUEST["toChapterId"];
    $chapter = getChapter($chapterId);
} else if (!empty($_REQUEST["storyId"])){
    $storyId = $_REQUEST["storyId"];
    $chapter = getFirstChapter($storyId);
    
}
$choices = getChoices($chapter['chapterId']); 


echo "
    <!DOCTYPE html
    <head>
        <meta charset='utf-8'>
        <link rel='stylesheet' href='style.css'> 
    </head>
    
    <body>
        <div class='grid-container'>"; 
            // linking to the chapters 
            echo "<div href='view_chapter.php?chapterId=".$chapter['chapterId']."'> ".$chapter['title']."</div>
            <div style= 'font-size:19px'>".$chapter['text']."</div> </div>"; 

            foreach($choices as $index => $choice){
               echo" <div><a href='view_chapter.php?toChapterId=".$choice['toChapterId']."'>".$choice['choiceText']."</a></div>"; 
            }
            if($chapter['isEnd']){
                echo "<div> This is the end </div>
                <a href='view_chapter.php?storyId=".$chapter['storyId']."'> Read again! </a> <br>
                    <a href='library_page.php'>Try another story</a>"; 
            }
    echo "
        </div>
    </body>"; 