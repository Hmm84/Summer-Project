<?php
include("../include/init.php"); 

echoHeader("Navigation Page"); 

echo "
<div class='nav-wrapper'>
  <div class='nav-column'>
    <a href='delete_story.php' target=_blank >Delete a story</a>
    <a href='create_story.php' target=_blank>Create a story</a>
    <a href='chat.php' target=_blank>Generate a story</a>
    <a href='library_page.php' target=_blank>The library</a>
    <a href='home_page.php' target=_blank>Home page</a>
  </div>
</div>

"; 

echoFooter(); 