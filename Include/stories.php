<?php
function getAllStories(){
    $stories = dbQuery("
        SELECT * FROM `stories`
        WHERE dateArchive IS NULL 
    ")->fetchAll(); 

    return $stories; 
}

function getStory($storyId){
    $story = dbQuery("
    SELECT * 
    FROM `stories` 
    WHERE `storyId` = (:storyId)
    AND dateArchive IS NULL
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
        SELECT chapters.*
        FROM `chapters`
        JOIN stories ON stories.storyId = chapters.storyId
        WHERE chapters.storyId = :storyId
        AND stories.dateArchive IS NULL
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

function getLastInsertedId() {
    global $pdo; 
    return $pdo->lastInsertId();
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
        'isStart' => $chapter['isStart'] ? 1 : 0, 
        'isEnd' => $chapter['isEnd'] ? 1 : 0
    ]);

    return getLastInsertedId(); 
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

function archiveStory($storyId){
    dbquery("
    UPDATE `stories`
    SET `dateArchive` = :dateArchive
    WHERE `storyId` = :storyId
    ", [
        'dateArchive' => date("Y-m-d H:i:s"), 
        'storyId' => $storyId
    ]); 
}

function createStory($title, $description){
    dbquery("
        INSERT INTO `stories` (`title`, `description`, `dateCreated`) 
        VALUES (:title, :description, :dateCreated)", [
            'title' => $title,
            'description' => $description,
            'dateCreated' => date("Y-m-d H:i:s")
        ]); 
}

function getChoicesByChapter($storyId) {
    $choices = dbQuery("
        SELECT 
            choices.choiceId,
            choices.choiceText,
            choices.fromChapterId,
            choices.toChapterId
        FROM `choices`
        JOIN chapters ON choices.fromChapterId = chapters.chapterId
        WHERE chapters.storyId = :storyId;
    ", [
        'storyId' => $storyId
    ])->fetchAll();

    $grouped = [];
    foreach ($choices as $choice) {
        $grouped[$choice["fromChapterId"]][] = $choice;
    }

    return $grouped;
}

function updateStory($storyId, $title, $description) {
    dbQuery("
        UPDATE stories
        SET title = (:title), description = (:description)
        WHERE storyId = (:storyId)
    ", [
        'title' => $title,
        'description' => $description,
        'storyId' => $storyId
    ]);
}

function updateChapter($id, $desc, $isStart, $isEnd) {
    dbQuery("
        UPDATE chapters
        SET description = (:desc), isStart = (:isStart), isEnd = (:isEnd)
        WHERE chapterId = (:id)
    ", [
        'desc' => $desc,
        'isStart' => $isStart,
        'isEnd' => $isEnd,
        'id' => $id
    ]);
}

function updateChoice($id, $text, $nextId) {
    dbQuery("
        UPDATE choices
        SET text = (:text), nextChapterId = (:nextId)
        WHERE id = (:id)
    ", [
        'text' => $text,
        'nextId' => $nextId,
        'id' => $id
    ]);
}




