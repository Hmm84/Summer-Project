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

    // function getAllChapters(){
    //     $chapters = dbQuery("
    //     SELECT * FROM `chapters`
    //     ")->fetchAll(); 
    //     return $chapters; 
    // }

    // function getChapter($storyId){

    //     $chapter = dbQuery(" 
    //      SELECT *
    //      FROM chapters
    //      WHERE StoryId = $storyId 
    //      AND is_start= TRUE"); 

    //      return $chapter->fetch(); 
    //  }

     function getAllChapters($storyId){
       
        $chapter = dbQuery(" 
         SELECT *
         FROM chapters
         WHERE StoryId = $storyId 
         AND is_start= TRUE"); 

         return $chapter->fetch(); 
    }

    function getChapter($ChapterId){
        $AllChapter = getAllChapters($storyId); 
        return $AllChapter[$ChapterId];    
     }

