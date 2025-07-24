<?php
include("../include/init.php"); 
$stories = getAllStories();
$totalBooks = count($stories);
$totalRows = 6;
$booksPerRow = 2;
echoHeader("homePage", "libraryBody"); 


echo "<div class='roomWrapper'> 
    <div class='room'>
        <div class='wall left-wall'>
            <div class='square' style='transform: translate(-91px, -227px); order: 1;'>
                <a href='home_page.php'>
                <img class='img-poster'src='../images/fireplace.jpg'
                style='width: 100%; height: 100%; object-fit: cover; ' />
                </a>
            </div>

            <div class='poster' style=' height: 251px; width: 137px; transform: translate(61px, 16px);' >
                <img class='img-poster'src='../images/squirrel in poster.jpg'/>
            </div>

            <div class='poster' style='transform: translate(14px, -238px);' >
                <img class='img-poster'src='../images/kabaa.jpg'  />
            </div>
            <div class='poster' style='transform: translate(-45px, -26px);;'>
                <img class='img-poster'src='../images/kitten_pari.jpg'  />
            </div>
    </div>

    <div class='wall center-wall'>
        <div class='bookshelf' >";
            for ($i = 0; $i < $totalRows; $i++) {
                echo "<div class='books-row'>";
                for ($j = 0; $j < $booksPerRow; $j++) {
                    $index = $i * $booksPerRow + $j;
                    if ($index < $totalBooks) {
                        $story = $stories[$index];
                                echo "<div class='books'>
                                        <a href='view_story.php?storyId=" .$story['storyId']. "'>" .$story['title']. "</a>
                                    </div>";
                            } else {
                                echo "<div class='books empty'></div>";
                            }
                        }
        echo "</div>";
                    }

        echo "</div>
    </div>

    <div class='wall right-wall'>
        <div class='poster' style='height: 255px; width: 323px; transform: translate(62px, -239px);'>
        <h1> HOW TO PLAY </h1> 
        </div>

        <div class='square' style='transform: translate(-5px, 16px);'>
            <img class='img-poster'src='../images/kitten_heart.jpg' />
        </div>
        <div class='poster' style='transform: translate(40px, -66px);'>
            <img class='img-poster'src='../images/beach.jpg' />
            </a>
        </div>

        <div class='poster' style='transform: translate(-201px, -285px);' >
            <img class='img-poster'src='../images/totoro.jpg'  />
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
