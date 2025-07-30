<?php
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

