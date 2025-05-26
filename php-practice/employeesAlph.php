<?php

$names = [
    'Hamida', 'Isabelle', 'Zaid', 'Eva','Zack','Alana','Tyler','Emily', 
    'Bracken', 'Casey', 'Elle', 'Emma', 'Eunice', 'Grady', 'J. Yang', 'Lauren',
    'Maggie', 'Maya', 'Michael', 'Mitchell', 'Reno', 'Robert', 'Ruth', 
    'Ther'
    ]; 
sort($names); 

$length = count($names); 
for($x = 0; $x < $length; $x++){
    echo ($x + 1).". ";
    echo $names[$x];
    echo "<br>"; 
}