<?php
include("Include/init.php"); 
$stories = getAllStories();
$totalBooks = count($stories);
$totalRows = 6;
$booksPerRow = 2;

echo "<!DOCTYPE html>
<html>
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta charset='utf-8'>
    <link rel='stylesheet' href='library.css'>

    <style>
     .glass{
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 20px;
        border:1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    }
    </style>

</head>
<body>
    <div class='roomWrapper'>
        <div class='room'>
        <div class='wall left-wall'>
      
            <div class='circle' style='transform: translate(-91px, -227px); order: 1;'>
                <a href='home_page.php'>
                <img src='fireplace.jpg'
                style='width: 100%; height: 100%; object-fit: cover; ' />
                </a>
            </div>

            <div class='poster' style=' height: 251px; width: 137px; transform: translate(61px, 16px);' >
                <img src='squirrel in poster.jpg'
                style='width: 100%; height: 100%; object-fit: cover; ' />
            </div>

            <div class='poster' style='transform: translate(14px, -238px);' >
                <img src='kabaa.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>
            <div class='poster' style='transform: translate(-45px, -26px);;'>
                <img src='kitten_pari.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>
            

            
        </div>
        <div class='wall center-wall' id='bookshelf'>
            <div class='bookshelf' >";

    for ($i = 0; $i < $totalRows; $i++) {
        echo "<div class='book-row'>";
        for ($j = 0; $j < $booksPerRow; $j++) {
            $index = $i * $booksPerRow + $j;
            if ($index < $totalBooks) {
                $story = $stories[$index];
                echo "<div class='book'>
                        <a href='view_story.php?storyId=" .$story['storyId']. "'>" .$story['title']. "</a>
                    </div>";
            } else {
                echo "<div class='book empty'></div>";
            }
        }
        echo "</div>";
    }

    echo "      </div>
            </div>
        <div class='wall right-wall'>
            <div class='rectangle' style='height: 255px; width: 323px; transform: translate(62px, -239px);'>
              <h1> HOW TO PLAY </h1> 
            </div>

            <div class='poster' style='transform: translate(-5px, 16px);'>
                <img src='kitten_heart.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>
             <div class='circle' style='transform: translate(40px, -66px);'>
                <img src='beach.jpg'
                style='width: 100%; height: 100%; object-fit: cover; ' />
                </a>
            </div>

            <div class='poster' style='transform: translate(-201px, -285px);' >
                <img src='totoro.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>
           

        </div>
    </div>
        <div class='floor'>
            <div class='rug' style='box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3), inset 0 10px 15px rgba(255, 255, 255, 0.2), inset 0 -5px 10px rgba(0, 0, 0, 0.2);'>
            <div class='rug' style = 'width: 75%; background: antiquewhite; height: 70%;'></div>
            </div>
           
        </div>
    </div>
</body>
</html>";
