<?php
    function getAllStories(){
        $stories = dbQuery("
            SELECT * FROM `stories`
        ")->fetchAll(); 

        return $stories; 
    }

    function getStory($storyId){
        $AllStories = getAllStories(); 
        return $AllStories[$storyId]; 
    }