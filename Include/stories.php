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

    function getChapter($chapterId){
        $chapter = dbQuery("
        SELECT * 
        FROM `chapters`
        WHERE `chapterId` = $chapterId
        ")->fetch(); 
        return $chapter; 
    }

    function getFirstChapter($storyId){

        $chapter = dbQuery(" 
         SELECT *
         FROM chapters
         WHERE StoryId = $storyId 
         AND is_start = TRUE"); 

         return $chapter->fetch(); 
     }
    
     function getChoices($chapterId){

        $choice = dbQuery(" 
         SELECT * 
         FROM `choices` 
         WHERE `from_chapter_id` = $chapterId"); 

         return $choice->fetchAll(); 
     }

