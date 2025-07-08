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
        WHERE `storyId` = $storyId
    ")->fetch(); 

    return $story;    
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
        WHERE storyId = $storyId 
        AND isStart = TRUE
    ")->fetch(); 

    return $chapter; 
}

function getChoices($chapterId){
    $choice = dbQuery(" 
        SELECT * 
        FROM `choices` 
        WHERE `fromChapterId` = $chapterId
    ")->fetchAll(); 

    return $choice; 
}

