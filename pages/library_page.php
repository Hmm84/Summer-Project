<?php
include("../include/init.php"); 
$stories = getAllStories();
$totalBooks = count($stories);
$totalRows = 4;
$booksPerRow = 4;

if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION["storyId"])) {
    $story = getStory($_SESSION["storyId"]); 
    $chapter = getChapter($_SESSION["chapterId"]); 
    echo "
    <div class='popup-overlay'>
        <div class='modal'>
            <p class='message'>Would you like to continue reading <b>\"".$story["title"]."\"</b></p>
            <div class='options'>
            <a class='btn' style='height: 40%' href='view_story.php?toChapterId=".$_SESSION['chapterId']."'>Yes</a>
            <form method='post'>
                <button class='btn' name='close_popup'>No</button>
            </form>
            </div>
        </div>
      </div>
    ";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['close_popup'])) {
    unset($_SESSION['storyId']);
    unset($_SESSION['chapterId']); 
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['play'])) {
   echo "
    <div class='popup-overlay'>
        <div class='modal'>
            <p class='message'> This is how you play </b></p>
            <div class='options'>
            <form method='post'>
                <button class='btn' name='close_popup'>Close</button>
            </form>
            </div>
        </div>
      </div>
    ";
}

echoHeader("homePage", "library_body"); 

echo "

<div class='roomWrapper'> 
    <div class='room'>
        <div class='wall left-wall'>
        <div class='poster-grid'>
            <div class='poster' >
                <img class='img-poster'src='../images/fireplace.jpg'
                style='width: 100%; height: 100%; object-fit: cover; ' />
            </div>

            <div class='poster' >
                <img class='img-poster'src='../images/squirrel in poster.jpg'/>
            </div>

            <div class='poster'  >
                <img class='img-poster'src='../images/kabaa.jpg'  />
            </div>
            <div class='poster' >
                <img class='img-poster'src='../images/kitten_pari.jpg'  />
            </div>
            </div>
    </div>

    <div class='wall center-wall'>
        <div class='bookshelf' >";
        for ($i = 0; $i < $totalRows; $i++) {
            echo "<div class='books-row'>";
            
            for ($j = 0; $j < $booksPerRow; $j++) {
                $index = $i * $booksPerRow + $j;
                
                if (isset($stories[$index])) {
                    $story = $stories[$index];
                    
                    $isCodeBook = strpos(strtolower($story['title']), 'code') !== false;

                    $bookClass = $isCodeBook ? 'books special-book' : 'books';

                    echo "<div class='$bookClass'>
                            <div class='book-spine'>
                                <a href='view_story.php?storyId=" .$story['storyId']. "'>" .$story['title']. "</a>
                            </div>
                            </div>";
                } else {
                    echo "<div class='book decor'>
                            <img src='../images/plant.png' alt='plant' />
                            </div>";
                }
            }

            echo "</div>";
        }

        echo "</div>
    </div>

    <div class='wall right-wall'>
        <div class='poster-grid'>
            <form method='post'>
                <div class='poster'>
                <img class='img-poster'src='../images/play.png'>
                <button class='playbtn' name='play'>HOW TO PLAY</button> 
            </form>
                </div>

            <div class='poster' >
                <img class='img-poster'src='../images/kitten_heart.jpg' />
            </div>
            <div class='poster'>
                <img class='img-poster'src='../images/beach.jpg' />
                </a>
            </div>

            <div class='poster' >
                <img class='img-poster'src='../images/totoro.jpg'  />
            </div>
            </div>
        </div>
    </div>

    <div class='floor'>
        <div class='rug'>
        <div class='rug in'></div>
        </div>
    </div>
</div>"; 

echoFooter(); 
