<?php

function createPrompt($story, $tone, $setting, $numChapters, $details){
    return "Create a choose-your-own-adventure story.
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
}

function getAIResponse($prompt, $openaiApiKey){
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
        'Authorization: Bearer ' . $openaiApiKey
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch); 
    return $response; 
}

function formatResponse($outputText){
    $fixedJson = trim($outputText);

    if (substr($fixedJson, -1) !== ']') {
        $fixedJson .= ']';
    }
    $fixedJson = preg_replace('/,\s*}/', '}', $fixedJson);
    $fixedJson = preg_replace('/,\s*]/', ']', $fixedJson);

    $output = json_decode($fixedJson, true);
    return $output; 
}

function addToNotion($story, $output){

    if($story['title'] != NULL){
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

        return ("Sucessfully inserted into notion database!");
    } else {
        return ("Is not in notion! Check if story is null");
    }
}
