<?php
include("Include/init.php"); 

$stories = getAllStories(); 
// $storyId = $_REQUEST['stories']; 
// $chapters = getAllChapters($storyId); 
// debugOutput($chapters); 

// $chapterSummary = ""; 
// foreach($chapters as $chapter){
//     $chapterSummary .= "Chapter {$chapter['chapterId']}: {$chapter['title']} - {$chapter['description']}\n";
// }

// debugOutput($chapterSummary); 

// $prompt = "
//     You are continuing a story. there are the existing chapters:
//     $chapterSummary 
//     write 3 new cahpters. one should be an ending the others should include choices that lead to other chapters
// "; 

// debugOutput($prompt); 

// $env = parse_ini_file('.env'); 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $storyId = $_REQUEST['storyId'];
    $story = getStory($storyId);
    $numChapters = $_REQUEST['numChapters']; 
    // $user_input = $_POST['prompt']; 
    $prompt = "You are adding chapters to a story. The title of the story is \"".$story["title"]."\" and the description is: \"".$story["description"]."\"

I want you to create only ".$numChapters." new chapters for this story.

⚠️ Important formatting rules:
- Return ONLY valid JSON — nothing else.
- DO NOT include any explanation or text before or after the JSON.
- DO NOT use markdown formatting (no triple backticks like ```json).
- Use double quotes for all keys and string values (e.g. \"title\", not 'title').

📚 JSON format:
Return an array of objects where each object uses a chapterId as a key.

Each chapter object must contain the following keys:
- \"title\": a short string summarizing the chapter
- \"description\": a paragraph that moves the plot forward
- \"isEnd\": a boolean (true or false)
- \"choices\": an array (if isEnd is false), each with:
    - \"text\": a short action
    - \"nextChapterId\": integer referring to another chapter

Each choice should logically connect to another chapter.
At least 1 chapter must be an ending (\"isEnd\": true). Ending chapters should have no \"choices\".

⚠️ Your entire response must be valid JSON.
- Do NOT include extra text or explanation.
- Do NOT use triple backticks (```).
- Your response must start with `[` and end with `]` (a valid JSON array).
- Ensure all curly braces `{}` and square brackets `[]` are properly closed.


Example format:
[
  {
    \"1\": {
      \"title\": \"Lost Princess\",
      \"description\": \"...\", 
      \"isEnd\": false,
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
;

    $data = [
        "model" => "gpt-3.5-turbo",
        "messages" => [
            ["role" => "system", "content" => "You are a great writer, and generate chapters that are suspenseful and fun."],
            ["role" => "user", "content" => $prompt]
        ]
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
    curl_close($ch); 

    $responseData = json_decode($response, true); 
    $outputText = $responseData['choices']['0']['message']['content'] ?? 'No reponse'; 
    // foreach($output as $chapter){
    //     $chapterTitle = $chapter["title"];
    //     $chapterDescription = $chapter["description"];
    //     if(!empty($chapter['choices'])){
    //         foreach ($chapter["choices"] as $choice){
    //             $choiceText = $choce["text"]
    //             $nextChapterId = 
    //         }
    //     }
    // }

    $chapterIdMap = []; 
    $fixedJson = trim($outputText);


    if (substr($fixedJson, -1) !== ']') {
        $fixedJson .= ']';
    }


    $fixedJson = preg_replace('/,\s*}/', '}', $fixedJson);
    $fixedJson = preg_replace('/,\s*]/', ']', $fixedJson);


    $output = json_decode($fixedJson, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "JSON Decode Error: " . json_last_error_msg();
        echo "<pre>" . htmlentities($fixedJson) . "</pre>";
    }



  foreach ($output as $chapterWrapper) {
        foreach ($chapterWrapper as $aiChapterId => $chapter) {
            $realChapterId = insertChapter($storyId, $chapter);
            $chapterIdMap[$aiChapterId] = $realChapterId;
            if(!empty($chapter['choices'])){
                foreach ($chapter['choices'] as $choice) {
                    $choiceText = $choice['text'];
                    $nextAiChapterId = $choice['nextChapterId'];
                    $realFromId = $realChapterId;
                    $realToId = $chapterIdMap[$nextAiChapterId] ?? null;

                    if ($realToId !== null) {
                        insertChoice($realFromId, $realToId, $choiceText);
                    }
                }
            }
        }
    }


    // insert_test($output);

    // $notionToken = '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';
    // $databaseId = '22a8f8a6d80380119c89ecc6ab37a9f8';
    // $title = "Chat Message - " . date("Y-m-d H:i:s");

    // $notionData = [
    //     "parent" => ["database_id" => $databaseId],
    //     "properties" => [
    //         "Title" => [
    //             "title" => [[
    //                 "text" => ["content" => $title]
    //             ]]
    //         ],
    //         "Message" => [
    //             "rich_text" => [[
    //                 "text" => ["content" => $output]
    //             ]]
    //         ],
    //         "Timestamp" => [
    //             "date" => ["start" => date("c")]
    //         ]
    //     ]
    // ];

    // $notionCurl = curl_init("https://api.notion.com/v1/pages");
    // curl_setopt($notionCurl, CURLOPT_POSTFIELDS, json_encode($notionData));
    // curl_setopt($notionCurl, CURLOPT_HTTPHEADER, [
    //     "Authorization: Bearer $notionToken",
    //     "Content-Type: application/json",
    //     "Notion-Version: 2022-06-28"
    // ]);
    // curl_setopt($notionCurl, CURLOPT_RETURNTRANSFER, true);
    // $notionResponse = curl_exec($notionCurl);
    // curl_close($notionCurl);
}


echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Chat API Test</title>
</head>
<body> 
    <form method='POST' action='chat.php'>
        <label for='stories'> Stories </label>
        <select id='stories' name='storyId'>";
            foreach($stories as $story){
                echo "<option value=".$story['storyId'].">".$story['title']."</option>"; 
            }
        echo "</select> 
        <label>How many chapters should be added to this story?:</label>
        <input type='number' name='numChapters' required>
         <button type='submit'>Send</button>
         </form>
        ";
echo "</body>
</html>"; 

