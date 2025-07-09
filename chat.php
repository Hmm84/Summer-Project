<?php
include("Include/init.php"); 
// $env = parse_ini_file('.env'); 
$api_key ='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'; 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $chats = getAllChats(); 
    $user_input = $_POST['prompt']; 

    $data = [
        "model" => "gpt-3.5-turbo",
        "messages" => [
            ["role" => "system", "content" => "You are a great writer, and create stories that are suspenseful and fun."],
            ["role" => "user", "content" => $user_input]
        ]
    ]; 

    $ch = curl_init('https://api.openai.com/v1/chat/completions'); 

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json', 
        'Authorization: Bearer ' . $api_key
    ]); 

    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 

    $response = curl_exec($ch); 
    curl_close($ch); 

    $responseData = json_decode($response, true); 
    $output = $responseData['choices']['0']['message']['content'] ?? 'No reponse'; 

    debugOutput($output); 

    insert_test($output);












    $notionToken = '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';
    $databaseId = '22a8f8a6d80380119c89ecc6ab37a9f8';
    $title = "Chat Message - " . date("Y-m-d H:i:s");

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
                    "text" => ["content" => $output]
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat API Test</title>
</head>
<body>
    <form method="POST" action="chat.php">
        <label>Ask something:</label>
        <input type="text" name="prompt" required>
        <button type="submit">Send</button>
    </form>

    <?php if (!empty($output)): ?>
        <h3>Response:</h3>
        <p><?php echo nl2br(htmlspecialchars($output)); ?></p>
    <?php endif; ?>
</body>
</html>