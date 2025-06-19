<?php
    function getAllStories(){
        $stories = dbQuery("
            SELECT * FROM `stories`
        ")->fetchAll(); 

        return $stories; 
    }

    function getStory($storyId){
        $story = dbQuery("
        SELECT * 
        FROM `stories` 
        WHERE `storyId` = (:storyId)
        ", [
            'storyId' => $storyId
        ])->fetch();
        return $story; 
    }

    function getChapter($chapterId){
        $chapter = dbQuery("
        SELECT * 
        FROM `chapters`
        WHERE `chapterId` = (:chapterId)
        ", [
            'chapterId' => $chapterId
        ])->fetch(); 
        return $chapter; 
    }

    function getFirstChapter($storyId){

        $chapter = dbQuery(" 
         SELECT *
         FROM chapters
         WHERE StoryId = (:storyId)
         AND is_start = TRUE",
         [
            'storyId' => $storyId
         ]); 

         return $chapter->fetch(); 
     }
    
     function getChoices($chapterId){

        $choice = dbQuery(" 
         SELECT * 
         FROM `choices` 
         WHERE `from_chapter_id` = (:chapterId)", 
         [
            'chapterId' => $chapterId
         ]); 

         return $choice->fetchAll(); 
     }

