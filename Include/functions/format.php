<?php
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