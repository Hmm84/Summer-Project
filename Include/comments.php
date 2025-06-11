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
   
    // sql injection example 
    dbQuery( 
    "INSERT INTO `Comment`(content, name, datePosted) 
     VALUES ('$comment','$userName','$dateTimeStirng')
    "); 

    
}

function deleteComment($name){
   dbQuery(
    "DELETE FROM `Comment`
     WHERE `name` = ?", 
     [$name]
   ); 
}

function validateUser ($name, $password){
    $user = dbQuery("
    SELECT * 
    FROM `users` 
    WHERE `name` = '$name'
    AND `password` = '$password'
    ")->fetch(); 

    return $user; 
}

function getAllUsers(){
    $users = dbQuery("
        SELECT * FROM `users`
    ")->fetchAll(); 

    return $users; 
}

function getUser($userId){   
    $AllUsers = getAllUsers(); 
    foreach($AllUsers as $user){
       if($user['userId'] == $userId){
        return $user; 
       }
    }
}
