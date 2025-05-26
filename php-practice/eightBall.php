<?php

$answers = 
    [
        'yes', 'no', 'maybe', 'dont think <br> on it', 'def', 'hell naw', 'no doubt <br> about it'
    ]; 
    
    echo "<div 
        style='font-size:106px; text-align:center;'>  
         EIGHT BALL 
        </div>"; 

    echo "<span 
        style='height:500px; width:500px; 
        background-color:#000000; 
        border-radius:50%; 
        display:inline-block; 
        position:relative; 
        left:34%;'></span>";

    echo "<div 
        style= 'width:0; 
        height:0; 
        border-left:100px 
        solid transparent; 
        border-right: 100px solid transparent;
        border-top: 200px solid #32174a; 
        position: relative; 
        top: -332px; 
        right: -654px;'> </div>"; 

$length = count($answers); 
$random = rand(0, $length-1); 
for($x = 0; $x < $length; $x++){
    if($random == $x){
        echo "
			<div 
                style='font-size: 25px;
                text-align: center;
                position: relative;
                top: -480px;
                color: antiquewhite;'> ".$answers[$x].
            "</div>"; 
    }
}
