<?php

function insert_test($text){
   dbquery("
   INSERT INTO `chats`(`text`) 
   VALUES (':text')", 
    [
        'test' => $test
    ]); 
}