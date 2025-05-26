<?php

// $question = htmlspecialchars($question); 

$answers = 
    [
        'yes', 'no', 'maybe', 'dont think on it', 'def', 'hell naw', 'no doubt about it'
    ]; 
    echo "
    <div style='font-size:106px; text-align:center;'>  EIGHT BALL </div>
    "; 

$length = count($answers); 
$random = rand(0, $length); 
for($x = 0; $x < $length; $x++){
    if($random == $x){
        echo "
			<div style='font-size:100px; text-align:center;'> ".$answers[$x]."</div>
            "; 
    }
}
