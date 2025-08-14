<?php
include("../include/init.php");

$stories = getAllStories();
$totalBooks = count($stories);
$totalRows = 4;
$booksPerRowOptions = [5, 6, 7];



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['seen_pageloop'])) {
    $_SESSION['seen_pageloop'] = true;
    $showSplash = true;
} else {
    $showSplash = false;
}

if ($showSplash) {
    echo "
    <div class='popup-overlay'>
      <div class='modal'>
        <h1 class='pageloop-logo'>PageLoop</h1>
        <p>Every click is a new twist!</p>
        <form method='post'>
          <button class='btn' name='close_splash'>Enter Library</button>
        </form>
      </div>
    </div>
    ";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['close_splash'])) {
    // Just reload the page without the splash
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}



if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!empty($_SESSION["storyId"])) {
    $story   = getStory($_SESSION["storyId"]);
    $chapter = getChapter($_SESSION["chapterId"]);

    echo "
    <div class='popup-overlay'>
      <div class='modal'>
        <p class='message'>Would you like to continue reading <b>\"" . htmlspecialchars($story["title"]) . "\"</b>?</p>
        <div class='options'>
          <a class='btn' style='height:40%' href='view_story.php?toChapterId=" . $_SESSION['chapterId'] . "'>Yes</a>
          <form method='post'><button class='btn' name='close_popup'>No</button></form>
        </div>
      </div>
    </div>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['close_popup'])) {
    unset($_SESSION['storyId'], $_SESSION['chapterId']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['play'])) {
    echo "
    <div class='popup-overlay'>
      <div class='modal'>
        <h2>How to Play</h2>
        <p>Welcome! Here's how to enjoy your interactive stories:</p>
        <ol>
          <li><strong>Browse and select a story</strong> that interests you from the list.</li>
          <li><strong>Read the story description</strong> to get a quick idea before starting.</li>
          <li>Click to <strong>start reading</strong>.</li>
          <li>Make <strong>choices</strong> as you go—pick your path.</li>
          <li>At an <strong>ending</strong>, you can <strong>replay</strong> or go back to the list.</li>
          <li>If you leave mid-story, we'll <strong>offer to resume</strong> next time.</li>
        </ol>
        <form method='post'><button class='btn' name='close_popup'>Close</button></form>
      </div>
    </div>";
}


echoHeader("Library", "library_body");


$fillerTitles = ['The Wandering Tale', 'Echoes of Dawn', 'Mystic Scrolls', 'Legends Reborn', 'The Hollow Pages'];
$palette = ['brown', 'gold', 'green', 'beige', 'burgundy', 'navy']; 


echo "
<div class='roomWrapper'>
  <div class='room'>


    <div class='wall left-wall'>
      <div class='poster-grid'>
        <div class='poster'>
          <img class='img-poster' src='../images/bridge.jpg' style='width:100%;height:100%;object-fit:cover;' />
        </div>
        <div class='poster'>
          <img class='img-poster' src='../images/trees.jpg' />
        </div>
        <div class='poster'>
          <img class='img-poster' src='../images/kabaa.jpg' />
        </div>
        <div class='poster'>
          <img class='img-poster' src='../images/ducks.jpeg' />
        </div>
      </div>
    </div>


    <div class='wall center-wall'>
      <div class='bookshelf'>
";

for ($i = 0; $i < $totalRows; $i++) {
    $booksPerRow = $booksPerRowOptions[array_rand($booksPerRowOptions)];

    $rowExtraClass = '';
    if ($i === 0) $rowExtraClass .= ' has-plant';
    if ($i === 2) $rowExtraClass .= ' has-stack';

    echo "<div class='books-row{$rowExtraClass}'>";


    if ($i === 0) {
        echo "<img src='../images/plant.png' alt='Plant' class='shelf-decor shelf-plant'>";
    }
   if ($i === 2) {
  
        $stackTitles = ['Legends Reborn', 'Echoes of Dawn', 'Mystic Scrolls', 'Field Notes'];

        echo "
        <div class='shelf-decor shelf-stack' aria-label='stacked books'>
        <div class='stacked-book book-brown'><span class='stack-title'>".$stackTitles[0]."</span></div>
        <div class='stacked-book book-gold'><span class='stack-title'>".$stackTitles[1]."</span></div>
        <div class='stacked-book book-green'><span class='stack-title'>".$stackTitles[2]."</span></div>
        <div class='stacked-book book-burgundy'><span class='stack-title'>".$stackTitles[3]."</span></div>
        </div>
        ";
    }

    for ($j = 0; $j < $booksPerRow; $j++) {
        $index = $i * $booksPerRow + $j;
        $color = $palette[array_rand($palette)];

        if (isset($stories[$index])) {
            $story = $stories[$index];
            $isCodeBook = strpos(strtolower($story['title']), 'code') !== false;
            $bookClass = ($isCodeBook ? 'books special-book' : 'books') . " book-{$color}";

            echo "
            <div class='" . $bookClass . "'>
              <div class='book-spine'>
                <a href='view_story.php?storyId=" . $story['storyId'] . "'>" . htmlspecialchars($story['title']) . "</a>
              </div>
            </div>
            ";
        } else {
            $title = $fillerTitles[array_rand($fillerTitles)];
            echo "
            <div class='books filler-book book-{$color}'>
              <span class='book-spine'>" . htmlspecialchars($title) . "</span>
            </div>
            ";
        }
    }

    echo "</div>"; 
}

echo "
      </div> 
    </div> 

  
    <div class='wall right-wall'>
      <div class='poster-grid'>
        <form method='post'>
            <div class='poster'>
            <img class='img-poster'src='../images/plays.png'>
            <button class='playbtn' name='play'> HOW TO PLAY </button> 
        </form>
            </div>
        <div class='poster'>
          <img class='img-poster' src='../images/kitten_heart.jpg' />
        </div>
        <div class='poster'>
          <img class='img-poster' src='../images/sunset.jpg' />
        </div>
        <div class='poster'>
          <img class='img-poster' src='../images/totoro.jpg' />
        </div>
      </div>
    </div>

  </div> 


  <div class='floor'>
    <div class='rug'><div class='rug in'></div></div>
  </div>
</div>
";

echoFooter();