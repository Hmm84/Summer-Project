<?php
include("Include/init.php"); 
$stories = getAllStories();
$totalBooks = count($stories);
$totalRows = 6;
$booksPerRow = 2;

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <link rel='stylesheet' href='library.css'>
</head>
<body>
    <div class='room'>
        <div class='wall left-wall'>
            <div class='circle'>
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>
            <div class='poster' style='position: absolute; top: 128px; right: 226px; height: 250px; width: 120px;' >
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>
            <div class='poster' style='position: absolute; top: 265px; right: 21px;' >
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>
        </div>
        <div class='wall center-wall'>
            <div class='bookshelf'>";

for ($i = 0; $i < $totalRows; $i++) {
    echo "<div class='book-row'>";
    for ($j = 0; $j < $booksPerRow; $j++) {
        $index = $i * $booksPerRow + $j;
        if ($index < $totalBooks) {
            $story = $stories[$index];
            echo "<div class='book'>
                    <a href='view_story.php?storyId=" . $story['storyId'] . "'>" . $story['title'] . "</a>
                  </div>";
        } else {
            echo "<div class='book empty'></div>";
        }
    }
    echo "</div>";
}

echo " 
                </div>
            </div>
        <div class='wall right-wall'>
            <div class='rectangle' style='position: absolute; top: 121px; left: 36px;' >
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>
            <div class='poster' style='position: absolute; top: 82px; right: 95px;' >
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>
            <div class='poster' style='position: absolute; top: 241px; right: 297px;' >
                <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Fronalpstock_big.jpg/800px-Fronalpstock_big.jpg' 
                style='width: 100%; height: 100%; object-fit: cover;' />
            </div>
        </div>
        
        <div class='floor'>
            <div class='rug'></div>
        </div>
    </div>
</body>
</html>";
