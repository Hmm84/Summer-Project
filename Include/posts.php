<?php
    function getAllPosts(){
        $posts = dbQuery("
            SELECT *
            FROM posts
        ")->fetchAll(); 

        return $posts; 
    }

    function getPost($PostId){
        $AllPosts = getAllPosts(); 
        return $AllPosts[$PostId]; 
    }