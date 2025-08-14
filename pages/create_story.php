<?php

include("../include/init.php"); 
echoHeader("Create story", "form-body"); 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = $_REQUEST["title"]; 
    $description = $_REQUEST["description"]; 
    createStory($title, $description); 

     echo "<div> Success! </div>
        <a href='chat.php'> Now to generate! </a>"; 
}else{

echo "<form method='POST' action='' class='form-box'>
        <h2> Create a Story </h2>
        <label for='title'> Title: </label>
        <input id='text' name='title' required>
        <label for='description'> Story Description: </label>
        <input type='text' name='description' required>
            <button class='form-buttons'type='submit'>Submit</button> 
    </form>"; 
}
echoFooter(); 