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

        .padding-section-medium{
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
    </style>
</head>
<body>
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

    <div class="container"> 
    <!-- Photo album  -->

        <div>
            <p> Hi! I am Hamida Mohamed — a passionate and curious mind blending creativity, tech, and problem-solving. 
                I am currently studying Computer Science with a minor in Business Administration, 
                and I enjoy building projects that combine function with beauty. 
                With experience across web, mobile, and embedded development,
                I am always exploring new ideas, technologies, and ways to grow. 
                Outside of code, you’ll find me painting, exploring the outdoors, or diving into new challenges.
            </p> 
        </div>
  
    </div>
    


</body>