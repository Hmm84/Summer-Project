<?php
$names = [
    'Hamida','Amyrah','Aisha','Haritha','Asma','Hanifa','Talha','Ubaidullah','Abdiwahab','Abdulaziz','Halima', 'Mohamed', 'Abdullah', 
    'Isabelle', 'Zaid', 'Eva','Zack','Alana','Tyler','Emily', 
    'Bracken', 'Casey', 'Elle', 'Emma', 'Eunice', 'Grady', 'J. Yang', 'Lauren',
    'Maggie', 'Maya', 'Michael', 'Mitchell', 'Reno', 'Robert', 'Ruth', 
    'Ther'
]; 

$length = count($names); 
$random = rand(0, $length); 
for($x = 0; $x < $length; $x++){
    if($random == $x){
        echo "Player: " .$names[$x]; 
    }
}
