<?php
    include("Include/init.php"); 
    $comments = getComments(); 


    // debugOutput($comments); 


    echo "Comment Section"; 
    foreach($comments as $comment){
        $name = $comment['name']; 
        $content = $comment['content']; 
        echo "<div><strong>".htmlspecialchars($name).":</strong>  ".htmlspecialchars($content)."</div>"; 
    }

    if(isset($_REQUEST['username']) && isset($_REQUEST['comment'])){
        insertComment($_REQUEST['username'], $_REQUEST['comment']); 
        header("location: form_practice.php");
        exit;  
    }; 

    if(isset($_REQUEST['username'])){
        deleteCommen($_REQUEST['username']); 
        header("location: form_practice.php");
        exit;  
    }; 
    debugOutput($_REQUEST);


?>

<html>
    <head>
        <style>
            .container {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <form action="" method="post">
                name: <input type="text" name="username">
                comment: <input type="text" name="comment">
                <input type="submit">
            </form>
        </div>
    </body>
</html> 