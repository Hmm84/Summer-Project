<?php
set_time_limit(500); 
include("Include/init.php"); 

$stories = getAllStories(); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $storyId = $_REQUEST['storyId'];
    $story = getStory($storyId);
    $tone = $_REQUEST['tone'];
    $numChapters = $_REQUEST['numChapters'];
    $setting = $_REQUEST['setting'];
    $details = $_REQUEST['twist']; 

    $prompt = "Create a choose-your-own-adventure story.
        The title of the story is \"".$story["title"]."\" and the description is: \"".$story["description"]."\"
        The setting of the story is ".$setting.". 
        I want you to create only ".$numChapters." chapters which would create a complete story. Chapters may be short. 
        The tone of the overall story is ".$tone.". 
        Here are more details that must be added to the story ".$details.". 

        Make sure the story feels natural and aligned with the tone and genre. The narrative should be fun, engaging, and specific with dialogue — avoid vague or generic writing. 
        Keep the story internally consistent based on the time, place, and main character's personality.

        Story Rules:
        The story must follow a branching structure with meaningful choices. Each chapter should offer 2 options leading to other chapters.
        Only one chapter can have 'isStart': true.
        At least one chapter must have 'isEnd': true, and ending chapters should have no choices.
        Every choice must lead to an existing chapter no broken paths.
        Endings should be satisfying and specific. No vague cliffhangers like “but what happens next?”

        Style Requirements:
        - Use modern, natural-sounding language that fits the tone.
        - Describe actions, characters, and settings with vivid detail.
        - Dialogue should match the tone.
        - Choices must reflect the main character's personality and setting.
        - Every chapter should move the story forward meaningfully.

        IMPORTANT: 
        - Chapters marked as endings (\"isEnd\": true) must provide a satisfying conclusion to that story path.  
        - Endings should clearly resolve the main conflict or character goal. They must be complete and not leave the reader with cliffhangers or open questions.   
        - Every choice in every chapter must lead to an existing chapter.  
        - At least one chapter must be marked as an ending (\"isEnd\": true) with no choices.  
        - If needed, the total number of chapters can be increased beyond the requested number ONLY to add necessary ending chapters so that all paths close properly.

        Important formatting rules:
        - Return ONLY valid JSON nothing else.
        - DO NOT include any explanation or text before or after the JSON.
        - DO NOT use markdown formatting (no triple backticks like json).
        - Use double quotes for all keys and string values (e.g. \"title\", not 'title').

        JSON format:
        Return an array of objects where each object uses a chapterId as a key.

        Each chapter object must contain the following keys:
        - \"title\": a short string summarizing the chapter
        - \"description\": a paragraph that moves the plot forward
        - \"isEnd\": a boolean (true or false)
        - \"isStart\": a boolean (true or false)
        - \"choices\": an array (if isEnd is false), each with:
            - \"text\": a short action
            - \"nextChapterId\": integer referring to another chapter

        Example format:
        [
        {
            \"1\": {
            \"title\": \"Lost Princess\",
            \"description\": \"...\", 
            \"isEnd\": false,
            \"isStart\": false,
            \"choices\": [
                {\"text\": \"Go left\", \"nextChapterId\": 2},
                {\"text\": \"Go right\", \"nextChapterId\": 3}
            ]
            }
        },
        {
            \"2\": { ... }
        }
        ]  
    ";

    $data = [
        "model" => "gpt-4",
        "messages" => [
            ["role" => "system", "content" => "You are a master interactive fiction author who specializes in writing immersive, suspenseful, and dynamic Choose Your Own Adventure stories. 
                Your writing is cinematic and emotionally engaging, with a strong focus on pacing, tension, and player agency.
                Always write in second person ('you') to make the reader feel like the main character.
                Use evocative language that draws the reader into the story based on the tone.
                You are not just writing a story you are simulating a living, branching experience. 
                Your goal is to make every choice feel meaningful, every outcome feel earned, and every path feel like part of a rich, connected world.
                Let your creativity shine within the constraints of the prompt. Only generate the requested content; do not break format."],
            ["role" => "user", "content" => $prompt]
        ],
        "max_tokens" => 2048, 
        "temperature" => 1
    ];


    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . API_KEY
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        debugOutput(["curlError" => $error_msg]);
        curl_close($ch);
        exit("CURL error occurred. Check debug output.");
    }
    curl_close($ch);

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

    debugOutput([$outputText]);

    $fixedJson = trim($outputText);

    if (substr($fixedJson, -1) !== ']') {
        $fixedJson .= ']';
    }
    $fixedJson = preg_replace('/,\s*}/', '}', $fixedJson);
    $fixedJson = preg_replace('/,\s*]/', ']', $fixedJson);

    $output = json_decode($fixedJson, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        debugOutput([
            "jsonDecodeError" => json_last_error_msg(),
            "fixedJson" => $fixedJson
        ]);
        exit("JSON decode failed.");
    }

  foreach ($output as $chapterWrapper) {
        foreach ($chapterWrapper as $aiChapterId => &$chapter) {
            if (empty($chapter['choices']) && !$chapter['isEnd']) {
            $chapter['isEnd'] = true;
            }

            if (!empty($chapter['choices']) && $chapter['isEnd']) {
                $chapter['isEnd'] = false;
            }
        }
    }

    foreach ($output as $chapterWrapper) {
        foreach ($chapterWrapper as $aiChapterId => &$chapter) {
            if ($chapter['isEnd']) {
                if (preg_match('/\?\s*$/', $chapter['description'])) {
                    $chapter['description'] .= " But the moment has passed, and your journey has reached its final chapter.";
                }
            }
        }
    }

    $chapterIdMap = [];


    foreach ($output as $chapterWrapper) {
        foreach ($chapterWrapper as $aiChapterId => $chapter) {
            insertChapter($storyId, $chapter);  
            $realChapterId = getLastInsertedId();  
            $chapterIdMap[$aiChapterId] = $realChapterId;
        }
    }


    foreach ($output as $chapterWrapper) {
        foreach ($chapterWrapper as $aiChapterId => $chapter) {
            if (!empty($chapter['choices'])) {
                $realFromId = $chapterIdMap[$aiChapterId] ?? null;

                foreach ($chapter['choices'] as $choice) {
                    $choiceText = $choice['text'];
                    $nextAiChapterId = $choice['nextChapterId'];
                    $realToId = $chapterIdMap[$nextAiChapterId] ?? null;

                    if ($realFromId !== null && $realToId !== null) {
                        insertChoice($realFromId, $realToId, $choiceText);
                    } 
                }
            }
        }
    }


    $notionToken = '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';
    $databaseId = '22a8f8a6d80380119c89ecc6ab37a9f8';
    $title = $story['title'];

    $notionData = [
        "parent" => ["database_id" => $databaseId],
        "properties" => [
            "Title" => [
                "title" => [[
                    "text" => ["content" => $title]
                ]]
            ],
            "Message" => [
                "rich_text" => [[
                    "text" => ["content" => json_encode($output, JSON_UNESCAPED_UNICODE)]
                ]]
            ],
            "Timestamp" => [
                "date" => ["start" => date("c")]
            ]
        ]
    ];

    $notionCurl = curl_init("https://api.notion.com/v1/pages");
    curl_setopt($notionCurl, CURLOPT_POSTFIELDS, json_encode($notionData));
    curl_setopt($notionCurl, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $notionToken",
        "Content-Type: application/json",
        "Notion-Version: 2022-06-28"
    ]);
    curl_setopt($notionCurl, CURLOPT_RETURNTRANSFER, true);
    $notionResponse = curl_exec($notionCurl);
    curl_close($notionCurl);
}


echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
     <link rel='stylesheet' href='chat.css'> 
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
        <label> Number of Chapters: </label>
        <input type='number' name='numChapters' >
          <label> Tone: </label>
        <input type='text' name='tone'>
        <label> Setting: </label>
        <input type='text' name='setting'>
        <label> Other details: </label>
        <input type='text' name='twist'>
        <button class='form-buttons' type='submit'>Send</button>
    </form>

</body>
</html>"; 

