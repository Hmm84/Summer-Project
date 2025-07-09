<?php
include("include/init.php"); 
$storyId = $_REQUEST['storyId']; 
$story = getStory($storyId); 

if(!empty($_REQUEST["toChapterId"])){
    $chapterId = $_REQUEST["toChapterId"];
    $chapter = getChapter($chapterId);
} else if (!empty($_REQUEST["storyId"])){
    $chapter = getFirstChapter($storyId);   
}

$choices = getChoices($chapter['chapterId']); 

echo "
    <!DOCTYPE html
    <head>
        <meta charset='utf-8'>
        <link rel='stylesheet' href='book.css'> 
    </head>
    
    <body>
        <div>
        
            <div> 
                <h2>".$story['title']."</h2>
                <p>".$story['description']."</p> 
                <h2>".$chapter['title']."</h2>
                <p>".$chapter['description']."</p>
               "; 
               foreach($choices as $choice){
                echo "<p>".$choice['choiceText']."</p>"; 
               }
            echo "</div>
        </div>
    </body>"; 