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
echo "<div class='book'>"; 
    if (!empty($story)) { 
        echo "<div class='left-page'>
            <h2>".$story['title']." </h2>
            <p>".$story['description']."</p>
        </div>
        <div class='right-page'>
            <a class='choice' href='view_story.php?storyId=". $story['storyId']."&read=true'>Read This Story</a><br>
            <a class='choice' href='library_page.php'>Go Back</a>
        </div>"; 

    } elseif (!empty($chapter)) { 
        echo "<div class='left-page'>
            <h2>". $chapter['title']."</h2>
            <p>".$chapter['description']."</p>
        </div>
        <div class='right-page'>"; 
            foreach ($choices as $choice) { 
                echo"<div class='choice'>
                    <a href='view_story.php?toChapterId=".$choice['toChapterId']."'>".$choice['choiceText']."</a>
                </div>"; 
            } if ($chapter['isEnd']) { 
                echo "<p>This is the end!</p>
                <a class='choice' href='view_story.php?storyId=".$chapter['storyId']."&read=true'>Read Again</a><br>
                <a class='choice' href='library_page.php'>Try Another Story</a>"; 
            } echo "
        </div>"; } else { echo"
        <div class='left-page'>
            <h2>Sorry, couldn't find the story or chapter.</h2>
        </div>
        <div class='right-page'>
            <a class='choice' href='library_page.php'>Go Back</a>
        </div>
        "; } echo " 
</div>"; 
echoFooter(); 
