<?php 
    include("Include/init.php"); 
    $posts = getAllPosts();
    $pageTitle = "Main page"; 
        $common = echoHeader($pageTitle);
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
        background-color: rgb(96 158 160);
        border-bottom: 1px double #ffffff;
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

        .titles{
            font-size: 150px;
            color: rgb(255 255 255);
            text-align: center;
            width: 1300px;
            margin: auto;
            margin-top: 242px;
            font-family: san-serif;
            font-variant: small-caps;
            text-shadow: 2px 4px black;
        }

        .container{
            display: grid;
            grid-template-columns: auto auto auto;
            padding: 10px;
            gap: 5px;
            font-size: 45px; 
            margin: auto; 
            right:250px; 
            width: 1000px; 
        }

        .container > div {
            padding: 5px;
            text-align: center;
            font-family: system-ui;
            border: 4px double #1c5b5d;
            background: cadetblue;
            border-radius: 31px;
        }

        .container:hover .overlay {
            opacity: 2; 
        }

        .overlay {
            position: relative;
            top: -70px; 
            left: 75px;
            width: 50%; 
            height: 50%; 
            opacity: 0;
            transition: .5s ease;
            background-color:rgba(28, 91, 93, 0.8);
         }
          
        .text {
            color:rgb(255, 255, 255);
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }




    </style>
</head>

<body style="background: #1c5b5d;">
   
    <!-- Navigation bar --> 
    <div>
        <ul>
    <li><a class="active" href="aboutme.php" class="designName"> All about me </a></li>
        <?php
            foreach($posts as $index => $post){
                echo "<li><a href='viewPost.php?postId=".$index."'> ".$post['title']."</a></li>";  
            }
            ?> 
    </ul>
        </div>
    
    <!-- Gonna boarder center background -->
     <div>
        <!-- Title of the main page --> 
        <div> <h1 class="titles"> Hamida Mohamed </h1></div>

        <!-- images with url to different pages -->
        <div class="container">
                <div> 
                    <a href="aboutMe.php"> 
                        <img src="kitty (1).png" style="width:120px;" >
                        <div class="overlay">
                            <div class="text"> About me </div>
                        </div>
                    </a>
                </div> 

                <?php
                    foreach($posts as $index => $post){
                        echo "
                        <div>
                            <a href='viewPost.php?postId=".$index."'> 
                                <img src='".$post['Image']."' style='width:110px;' >
                                    <div class='overlay'>
                                        <div class='text'>".$post['title']."</div>
                                    </div>
                            </a>
                        </div>";  
                    }
                ?> 
        </div>
    </div>     
</body>