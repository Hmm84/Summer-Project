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
        <link rel='stylesheet' href='../css/library.css'> 
        <link rel='stylesheet' href='book.css'> 
  
    </head>
    
    <body>
        <div class='book'>"; 
            // linking to the chapters 
            echo "<div class='left-page'; href='view_chapter.php?chapterId=".$chapter['chapterId']."'>
            <h2>".$chapter['title']."</h2>
            <p>".$chapter['text']."</p></div>
            
            <div class='right-page'>"; 

            foreach($choices as $index => $choice){
               echo" <div class='choice'><a href='view_chapter.php?toChapterId=".$choice['toChapterId']."'>".$choice['choiceText']."</a></div>"; 
            }
            echo "</div>"; 
            if($chapter['is_end']){
                echo "<div class='right-page'> 
                    <p>This is the end! </p>
                    <a class='choice'; href='view_chapter.php?storyId=".$chapter['storyId']."'> Read again! </a> <br>
                    <a class='choice'; href='library_page.php'>Try another story</a>
                </div>"; 
            }
    echo "
        </div>
    </body>"; 