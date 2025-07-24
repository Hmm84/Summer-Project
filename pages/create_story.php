<?php

include("../include/init.php"); 
echoHeader("Create story"); 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = $_REQUEST["title"]; 
    $description = $_REQUEST["description"]; 
    createStory($title, $description); 

     echo "<div> Success! </div>"; 
}else{

echo "<form method='POST' action='' class='form-box'>
        <h3> Create a Story </h3>
        <label for='title'> Title: </label>
        <input id='text' name='title' required>
        <label for='description'> Story Description: </label>
        <input type='text' name='description' required>
        <div class='form-buttons'>
            <button type='submit'>Submit</button> 
        </div>
    </form>"; 
}
echoFooter(); 