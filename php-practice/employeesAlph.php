<?php

$names = [
    'Hamida', 'Isabelle', 'Zaid', 'Eva','Zack','Alana','Tyler','Emily', 
    'Bracken', 'Casey', 'Elle', 'Emma', 'Eunice', 'Grady', 'J. Yang', 'Lauren',
    'Maggie', 'Maya', 'Michael', 'Mitchell', 'Reno', 'Robert', 'Ruth', 
    'Ther'
    ]; 
sort($names); 

$length = count($names); 

echo "<div style='
    display: grid;
    grid-template-columns: auto auto auto;
    padding: 10px;
    font-size: 25px;'>";

for($x = 0; $x < $length; $x++){
    echo "<div style= '  gap: 10px;
    background-color:rgb(87, 187, 132);
    border: 1px solid white;
    border-style:dashed; 
    text-align: center;'>".$names[$x]."</div>"; 
}
echo "</div>"; 