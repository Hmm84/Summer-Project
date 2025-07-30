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
        FROM `chapters`
        WHERE `storyId` = (:storyId)
        AND `isStart` = TRUE",
        [
            'storyId' => $storyId
        ])->fetch(); 

        return $chapter; 
    }
    
function getChoices($chapterId){

    $choice = dbQuery(" 
        SELECT * 
        FROM `choices` 
        WHERE `fromChapterId` =  :fromChapterId", 
        [
            'fromChapterId' => $chapterId
        ])->fetchAll(); 

    return $choice; 
}


function getAllChapters($storyId){
    $chapters = dbQuery("
        SELECT * FROM `chapters`
        WHERE `storyId` = :storyId",
        [
            'storyId' => $storyId
        ])->fetchAll(); 

    return $chapters; 
}

function getAllChats(){
    $chats= dbQuery("
        SELECT * FROM `chats`
    ")->fetchAll(); 

    return $chats; 
}

function insertChapter($storyId, $chapter){
    dbQuery("
        INSERT INTO `chapters` (`title`, `description`, `dateCreated`, `storyId`, `isStart`, `isEnd`)
        VALUES (:title, :description, :dateCreated, :storyId, :isStart, :isEnd)
    ", [
        'title' => $chapter['title'],
        'description' => $chapter['description'],
        'dateCreated' => date("Y-m-d H:i:s"),
        'storyId' => $storyId,
        'isStart' => $chapter['isStart'], 
        'isEnd' => $chapter['isEnd']
    ]);
}

function insertChoice( $fromChapterId, $toChapterId, $choiceText){
    dbquery ( "INSERT INTO `choices`(`fromChapterId`, `toChapterId`, `choiceText`) 
    VALUES (:fromChapterId, :toChapterId, :choiceText)
    ", [
        'fromChapterId' =>  $fromChapterId, 
        'toChapterId' =>  $toChapterId, 
        'choiceText' =>  $choiceText
    ]); 
}

function markChapterAsNotEnd($chapterId) {
    dbQuery("
        UPDATE `chapters`
        SET `isEnd` = 0
        WHERE `chapterId` = :chapterId
    ", [
        'chapterId' => $chapterId
    ]);
}