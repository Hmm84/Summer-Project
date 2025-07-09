<?php

function insert_test($text){
   dbquery("
   INSERT INTO `chats`(`text`) 
   VALUES (:text)", 
    [
        ':text' => $text
    ]); 
}

function getAllChats(){
    $chats= dbQuery("
        SELECT * FROM `chats`
    ")->fetchAll(); 

    return $chats; 
}


