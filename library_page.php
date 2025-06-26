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
    .hidden{
        opacity: 0;  
    }
    </style>

    <script>
        function isOverlapping(el1, el2) {
        const obj1 = el1.getBoundingClientRect();
        const obj2 = el2.getBoundingClientRect();
    
        return !(
            obj1.right < obj2.left ||
            obj1.left > obj2.right ||
            obj1.bottom < obj2.top ||
            obj1.top > obj2.bottom
        );
        }
    
      
        const bookshelf = document.getElementById('bookshelf');
        const image = document.getElementById('image');
    
        function checkCollisions() {
            if (isOverlapping(image, bookshelf) {
                image.classList.add('hidden');
            }
        }
  </script>

</head>
<body>
    <div class='roomWrapper'>
        <div class='room'>
        <div class='wall left-wall'>
      
            <div class='circle' id='image'>
                <a href='home_page.php'>
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg'
                style='width: 100%; height: 100%; object-fit: cover; ' />
                </a>
            </div>

            <div class='poster' style='top: 145px; left: 200px; height: 215px; width: 133px;' id='' >
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>

            <div class='poster' style='top: 265px; left: 380px;' id='' >
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg' 
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
            <div class='rectangle' style=' top: 121px; right: 260px;' id=''>
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' /> 
            </div>

            <div class='poster' style='top: 82px; right: 95px;' id=''>
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>

            <div class='poster' style='top: 241px; right: 290px;' id='' >
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg' 
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
