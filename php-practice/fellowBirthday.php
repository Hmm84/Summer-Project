<?php

$birthday=
    [
        ['Name' => 'Hamida', 'Birthday' => 'August 8'], 
        ['Name' => 'Alana', 'Birthday' => 'July 20'], 
        ['Name' => 'Isabella', 'Birthday' => 'September 7'], 
        ['Name' => 'Zack', 'Birthday' => 'September 20'], 
        ['Name' => 'Zaid', 'Birthday' => 'September 6'], 
    ]; 

$count = 0; 
 foreach($birthday as $day){
    $date = date_create($day['Birthday']); 
    date_modify($date, '+6 month');
    echo $day['Name']."'s half birthday is ".date_format($date, '<b>F, d</b>')."! <br>"; 
    $count++; 
 }