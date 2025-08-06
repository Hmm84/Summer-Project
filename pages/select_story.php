<?php
include("../Include/init.php"); 

$stories = getAllStories();

echoHeader("select story"); 

if (count($stories) === 0) {
    echo "<p>No stories found.</p>";
} else {
    echo "<form method='GET' action='edit_story.php' class='form-box'>
            <label for='storyId'>Choose a story:</label><br><br>
            <select name='id' id='storyId' required>";

    foreach ($stories as $story) {
        $title = htmlspecialchars($story['title']);
        echo "<option value='{$story['storyId']}'>{$title}</option>";
    }

    echo "</select><br><br>
        <input type='submit' value='Edit Story'>
        </form>";
}

echoFooter(); 
