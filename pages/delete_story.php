<?php

include("../include/init.php"); 
echoHeader("delete story"); 

$storyId = $_REQUEST["storyId"] ?? null;
if($storyId){
    archiveStory($storyId);
    echo "<div class='nav-wrapper'> 
        <div class='nav-column'>
        <h3> Success! </h3>
        <a href='delete_story.php'> Delete another story </a>
        <a href='nav_page.php'> Back to navigate! </a>
        </div>
    </div>"; 
} else {
    $stories = getAllStories(); 
echo"
    <form method='POST' action='' class='form-box'>
        <h3> Delete a Story </h3>
        <label for='stories'> Story: </label>
        <select id='stories' name='storyId'>";
            foreach($stories as $story){
                echo "<option value=".$story['storyId'].">".$story['title']."</option>"; 
            }
        echo "</select> 
        <div class='form-buttons'>
            <button type='submit'>Submit</button>
        </div>
    </form>"; 
}
echoFooter(); 