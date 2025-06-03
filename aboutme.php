<?php
    include("Include/init.php"); 
    $posts = getAllPosts();
    ?>


<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title> About me </title>
    <link rel="stylesheet" href="style.css"> 
    <style>
        body{
            margin:0;
        }
        .title{
            background-color: rgb(143, 15, 40); 
            color: aliceblue; 
            font-size: xxx-large;
            text-align: center; 
        }
        .container {
            display: flex; 
            background: grey;
            justify-content: center; 
        }
    </style>
</head>
<body>
    <div class="container"> 
    <!-- Photo album  -->
        
    
    </div>

     <!-- Navigation bar --> 
     <div>
        <ul>
            <li><a class="active" href="aboutme.php" class="designName"> All about me </a></li>
                <?php
                    foreach($posts as $index => $post){
                        echo "<li><a href='viewPost.php?postId=".$index."'> ".$post['title']."</a></li>";  
                    }
                ?> 
            <li><a class="active" href="index.php" class="designName"> Main Page </a></li>
        </ul>
    </div>
    


</body>