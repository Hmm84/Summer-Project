<?php

function getComments(){

    $comments = dbQuery(
        "SELECT * FROM `Comment`"
    )->fetchAll(); 
    
    return $comments; 
}

function insertComment($userName, $comment){
    $now = date_create('now'); 
    $dateTimeStirng = date_format($now, "Y-m-d H:i:s"); 
   
    dbQuery( 
    "INSERT INTO `Comment`(content, name, datePosted) 
    VALUES ('$comment','$userName','$dateTimeStirng')
    "); 

    
}
