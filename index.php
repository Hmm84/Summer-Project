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
        <div class='wall left-wall'></div>
        <div class='wall center-wall'>
            <div class='bookshelf'>";

// Generate rows
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
            // Empty book slot
            echo "<div class='book empty'></div>";
        }
    }
    echo "</div>";
}

echo " 
                </div>
            </div>
        <div class='wall right-wall'>
        <div class='note note-left'>home</div> </div>
        
        <div class='floor'>
            <div class='rug'></div>
        </div>
    </div>
</body>
</html>";
