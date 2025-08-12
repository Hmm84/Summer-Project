<?php
include("../include/init.php");

echoHeader("homePage");

if (!empty($_REQUEST["storyId"]) && !isset($_GET["read"])) {
    $storyId = $_REQUEST["storyId"];
    $story = getStory($storyId);
    $_SESSION["storyId"] = $storyId;

} else if (!empty($_GET["storyId"]) && isset($_GET["read"])) {
    $storyId = $_GET["storyId"];
    $chapter = getFirstChapter($storyId);
    if ($chapter) {
        $choices = getChoices($chapter['chapterId']);
    }

} else if (!empty($_REQUEST["toChapterId"])) {
    $chapterId = $_REQUEST["toChapterId"];
    $_SESSION["chapterId"] = $chapterId;
    $chapter = getChapter($chapterId);
    if ($chapter) {
        $choices = getChoices($chapter['chapterId']);
    }
}
echo "<div class='libraryBackground'>
<div class='bookHardcover'>"; 
    if (!empty($story)) { 
        echo "<div class='bookPage left-page'>
            <h2>".$story['title']." </h2>
            <p>".$story['description']."</p>
        </div>
        <div class='bookPage right-page'>
            <a class='bookBtn' href='view_story.php?storyId=". $story['storyId']."&read=true'>Read This Story</a><br>
            <a class='bookBtn' href='library_page.php'>Go Back</a>
        </div>"; 

    } elseif (!empty($chapter)) { 
        echo "<div class='bookPage left-page'>
            <h2>". $chapter['title']."</h2>
            <p>".$chapter['description']."</p>
        </div>
        <div class='bookPage right-page'>"; 
            foreach ($choices as $choice) { 
                echo"<div class='bookBtn'>
                    <a href='view_story.php?toChapterId=".$choice['toChapterId']."'>".$choice['choiceText']."</a>
                </div>"; 
            } if ($chapter['isEnd']) { 
                echo "<p style='text-align: center;'>This is the end!</p>
                <a class='bookBtn' href='view_story.php?storyId=".$chapter['storyId']."&read=true'>Read Again</a><br>
                <a class='bookBtn' href='library_page.php'>Try Another Story</a>"; 
            } echo "
        </div>"; } else { echo"
        <div class='bookPage left-page'>
            <h2>Sorry, couldn't find the story or chapter.</h2>
        </div>
        <div class='bookPage right-page'>
            <a class='bookbtn' href='library_page.php'>Go Back</a>
        </div>
        "; } echo " 
</div>
</div>"; 
echoFooter(); 
