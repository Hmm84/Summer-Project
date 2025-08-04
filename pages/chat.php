<?php
set_time_limit(500); 
include("../Include/init.php");

$stories = getAllStories(); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $storyId = $_REQUEST['storyId'];
    $story = getStory($storyId);
    $tone = $_REQUEST['tone'];
    $numChapters = $_REQUEST['numChapters'];
    $setting = $_REQUEST['setting'];
    $details = $_REQUEST['twist']; 

    $prompt = createPrompt($story, $tone, $setting, $numChapters, $details); 
    $response = getAIresponse($prompt, $openaiApiKey); 

    if (!$response) {
        debugOutput("No response received from API.");
        exit("No response from API.");
    }

    $responseData = json_decode($response, true);

    if (!isset($responseData['choices'][0]['message']['content'])) {
        debugOutput(["error" => "Malformed API response", "responseData" => $responseData]);
        exit("Malformed API response. Check debug.");
    }

    $outputText = $responseData['choices'][0]['message']['content'];

    if (json_last_error() !== JSON_ERROR_NONE) {
        debugOutput([
            "jsonDecodeError" => json_last_error_msg(),
            "fixedJson" => $fixedJson
        ]);
        exit("JSON decode failed.");
    }
    

    $output = json_decode($outputText); 

    $chapterIdMap = [];

    foreach ($output as $chapterWrapper) {
        foreach ($chapterWrapper as $aiChapterId => $chapter) {
            $realChapterId = insertChapter($storyId, $chapter);  
            $chapterIdMap[$aiChapterId] = $realChapterId;
            $realFromId = $chapterIdMap[$aiChapterId] ?? null;

            if ($realFromId !== null && !empty($chapter['choices'])) {
                foreach ($chapter['choices'] as $choice) {
                    $choiceText = $choice['text'];
                    $nextAiChapterId = $choice['nextChapterId'];
                    $realToId = $chapterIdMap[$nextAiChapterId] ?? null;

                    if ($realToId !== null) {
                        insertChoice($realFromId, $realToId, $choiceText);
                    }
                }
            }
        }
    }
    
    
    addToNotion($story, $output); 

}


echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
     <link rel='stylesheet' href='../css/chat.css'> 
    <title>Chat API Test</title>
</head>
<body> 
     <form method='POST' action='chat.php'class='form-box'>
        <label> Create a Story </label>
        <label for='stories'> Story: </label>
        <select id='stories' name='storyId'>";
            foreach($stories as $story){
                echo "<option value=".$story['storyId'].">".$story['title']."</option>"; 
            }
        echo "</select> 
        <label for='tone'>Choose a Tone:</label>
        <select name='tone' id='tone'>
            <option value='Adventure'>Adventure</option>
            <option value='Funny'>Funny</option>
            <option value='Mysterious'>Mysterious</option>
            <option value='Dark'>Dark</option>
            <option value='Romantic'>Romantic</option>
            <option value='Fantasy'>Fantasy</option>
            <option value='Sci-Fi'>Sci-Fi</option>
            <option value='Wholesome'>Wholesome</option>
            <option value='Dramatic'>Dramatic</option>
            <option value='Sad'>Sad</option>
            <option value='Empowering'>Empowering</option>
            <option value='Spooky'>Spooky</option>
            <option value='Surreal'>Surreal</option>
            <option value='Historical'>Historical</option>
        </select>
        <label> Number of Chapters: </label>
        <input type='number' name='numChapters' min='1' max='10'>
        <label> Setting: </label>
        <input type='text' name='setting'>
        <label> Other details: </label>
        <input type='text' name='twist'>
        <button class='form-buttons' type='submit'>Send</button>
    </form>

</body>
</html>"; 

