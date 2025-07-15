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
        ",
        [
            'storyId' => $storyId
        ])->fetch();
        return $story; 
    }

function getChapter($chapterId){
    $chapter = dbQuery("
        SELECT * 
        FROM `chapters`
        WHERE `chapterId` = (:chapterId)
        ",
        [
            'chapterId' => $chapterId
        ])->fetch(); 

        return $chapter; 
    }


    function getFirstChapter($storyId){

        $chapter = dbQuery(" 
         SELECT *
         FROM chapters
         WHERE StoryId = (:storyId)
         AND isStart = TRUE",
         [
            'storyId' => $storyId
         ])->fetch(); 

         return $chapter; 
     }
    
     function getChoices($chapterId){

        $choice = dbQuery(" 
         SELECT * 
         FROM `choices` 
         WHERE `fromChapterId =  (:chapterId)", 
         [
            'chapterId' => $chapterId
         ])->fetchAll(); 

    return $choice; 
}

