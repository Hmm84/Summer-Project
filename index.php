<?php 
    include("Include/init.php"); 
    $posts = getAllPosts();
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
        width: 10%;
        background-color: #f1f1f1;
        position: fixed;
        height: 100%;
        overflow: auto;
        }

        li a {
        display: block;
        color: #000;
        padding: 8px 16px;
        text-decoration: none;
        }

        li a.active {
        background-color:rgb(239, 144, 169, 0.54);
        color: white;
        font-weight: bold; 
        }

        li a:hover:not(.active) {
        background-color: #555;
        color: white;
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