<?php
include("../include/init.php"); 

echoHeader("Navigation Page"); 

echo "
<div class='nav-wrapper'>
  <div class='nav-column'>
    <a href='library_page.php'>The library</a>
    <a href='delete_story.php'>Delete a story</a>
    <a href='create_story.php' >Create a story</a>
    <a href='chat.php' >Generate a story</a>
    <a href='select_story.php'> Edit a story </a>
  </div>
</div>

"; 

echoFooter(); 