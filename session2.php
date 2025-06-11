<?php
include("Include/init.php");  

if((isset($_SESSION['userId']))){
    $currentUser = getUser($_SESSION['userId']); 
    $name = $currentUser['name']; 
    debugOutput($_SESSION); 
    
    echo "<div> Hello ".$name."</div>"; 
    echo "<a href =session.php?reason=loggedOut class='button'>Log Out</a>"; 
} else {
    header("Location: session.php"); 
}
