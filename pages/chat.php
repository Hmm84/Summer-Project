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
            "jsonDecodeError" => json_last_error_msg()
        ]);
        exit("JSON decode failed.");
    }
    debugOutput($outputText); 

    $output = json_decode($outputText); 

    $chapterIdMap = [];

    foreach ($output as $chapterWrapper) {
        foreach ($chapterWrapper as $aiChapterId => $chapter) {
            $realChapterId = insertChapter($storyId, $chapter);  
            $chapterIdMap[$aiChapterId] = $realChapterId;

            if ($realChapterId !== null && !empty($chapter['choices'])) {
                foreach ($chapter['choices'] as $choice) {
                    $choiceText = $choice['text'];
                    $nextAiChapterId = $choice['nextChapterId'];
                    $realToId = $chapterIdMap[$nextAiChapterId] ?? null;

                    if ($realToId !== null) {
                        insertChoice($realChapterId, $realToId, $choiceText);
                    }
                }
            }
        }
    }
    
    addToNotion($story, $output); 

}

echoHeader("Chat"); 

echo "<form method='POST' action='chat.php'class='form-box'>
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
        <label for='numChapters'> Number of Chapters: </label>
        <input type='number' id='numChapters' name='numChapters' min='1' max='10'>
        <label for='setting'> Setting: </label>
        <input type='text' id='setting' name='setting'>
        <label for='twist'> Other details: </label>
        <input type='text' id='twist' name='twist'>
        <button class='form-buttons' type='submit'>Send</button>
    </form>"; 
echoFooter(); 
