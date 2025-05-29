<?php 
    include("Include/init.php"); 
    $posts = getAllPosts();
    $pageTitle = "Main page"; 
        $common = echoHeader($pageTitle);
        debugOutput($common);
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title> All about ME </title>
    <link rel="stylesheet" href="style.css"> 

    <style>
        body {
        margin: 0;
        }

        ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden; 
        background-color:rgb(143, 15, 40);
        }

        li{
            float: right; 
        }

        li a {
        display: block;
        color: white;
        text-align: center; 
        padding: 8px 16px;
        text-decoration: none;
        font-family: system-ui;
        }

        li a:hover {
        background-color: #555;
        }
    </style>
</head>

<body style="background-image: url(https://media.istockphoto.com/id/539821468/vector/pink-seamless-gingham-pattern-vector.jpg?s=612x612&w=0&k=20&c=ZgLZQyyeKGQgt4gfaM9njN31XlEbgWopQ46tbOWT9y4=);">

    <ul>
    <li><a class="active" href="aboutme.php" class="designName"> All about me </a></li>
        <?php
            foreach($posts as $index => $post){
                echo "<li><a href='viewPost.php?postId=".$index."'> ".$post['title']."</a></li>";  
            }
            ?> 
    </ul>
    
</body>