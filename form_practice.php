<?php
    include("Include/init.php"); 
    $comments = getComments(); 

    // debugOutput($comments); 
    debugOutput($_REQUEST); 

    if(isset($_REQUEST['username']) && isset($_REQUEST['comment'])){
        insertComment($_REQUEST['username'], $_REQUEST['comment']); 
        header("location: form_practice.php");
        exit;  
    }; 

    ?>

<html>
    <body>
        <form action="" method="post">
            name: <input type="text" name="username">
            comment: <input type="text" name="comment">
            <input type="submit">
        </form>
    </div>
</html> 