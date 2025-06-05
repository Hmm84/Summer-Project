<?php
    function getAllUsers(){
        $users = dbQuery("
            SELECT * FROM `users`
        ")->fetchAll(); 

        return $users; 
    }

    function getUser($userId){
        $AllUsers = getAllUsers(); 
        return $AllUsers[$userId]; 
    }