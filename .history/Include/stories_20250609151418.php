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

    function getChapter($storyId){
       $chapter = dbQuery(" 
        SELECT *
        FROM chapters
        WHERE StoryId = $storyId"); 
    }

