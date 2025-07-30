<?php
function addToNotion($story, $output){
    global $notionToken; 
    if($story['title'] != NULL){
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
