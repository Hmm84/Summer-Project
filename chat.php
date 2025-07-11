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
    $prompt = "You are adding the chapters to a story. The title of the story is ".$story["title"]." and here is a short description of what the story should be about".$story['description']."I want you to add only ".$numChapters." chapters to the story.
        All the chapters should be returned in an array where the numerical key represents the `chapterId` and the value is the chapter itself is an array with the following format. A chapter array should have the following keys: 'title','description', 'isEnd', and 'choices'
        The title of a chapter is generally brief and somewhat summarizes what happens in the chapter.
        A chapter description is generally around a paragraph long and should move the plot of the story forward. 
        Each chapter should end with by offering 2 possible choices one could select to continue the story. The choices should make sense in the context of the chapter it follows. The selected choice should determine what chapter should come next in the story. The choices should be represented as an array under the `choices` key of the chapter object.
        The choice array should have the keys 'text' and 'nextChapterId'. The 'text' is generally brief and describes an action a character could can make in the story. The 'nextChapterId' represents the next chapter in the story based on the specific action that was taken. This should reference a specific key of the final chapter array that represents that chapters chapterId.
        Some chapters should be the end of the story, this should be indicated by the `isEnd` property and contain a boolean value (true if the chapter is the end and false if not).
        A story needs at least 1 chapter that is an ending and each path of selected of choices should eventually lead to an end chapter. If the chapter is an end, it should not have any choices. 
    ";

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
    debugOutput($outputText);

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
    $output = json_decode($outputText, true);

    foreach ($output as $aiChapterId => $chapter) {
        $realChapterId = insertChapter($storyId, $chapter);  
        $chapterIdMap[$aiChapterId] = $realChapterId;
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

