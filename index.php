<?php
    include("Include/init.php"); 
    $stories = getAllStories();
 
    echo "
        <!DOCTYPE html
        <head>
            <meta charset='utf-8'>
            <link rel='stylesheet' href='library.css'>
        </head>
        
        <body>
        <div style='width:353px; height:776px; flex-shrink:0;'> 
            <div class='bookshelfWrapper'>"; 
            // foreach loop to create a list all stories
            foreach($stories as $index => $story){
                if ($index == 0) {
                    echo "<div class='shelf'>";
                }else if ($index % 2 == 0) {
                    echo "</div> <div class='shelf'>";
                }
                echo "<div class='book'><a href='view_story.php?storyId=".$story['storyId']."'>".$story['title']."</a></div>";
            }

    echo "
        </div>
    </div>
    </body>"; 