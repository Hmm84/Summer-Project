<?php

$areaCodes = [
    [
        'areacode'=> '314', 'State'=> 'MO'
    ], 
    [
        'areacode'=> '212', 'State'=> 'NY'
    ],
    [
        'areacode'=>  '312', 'State'=> 'IL'
    ],
    [
        'areacode'=> '415', 'State'=> 'CA'
    ],
    [
        'areacode'=>  '512', 'State'=> 'TX'
    ],
]; 

$phoneNumber = [3146292716, 2128927178, 4156273829, 5127382916, 3124253728];
$count = 1; 

foreach ($phoneNumber as $number){
    $phoneNumberstr = strval($number); 
    $area = substr($number, 0, -7); 
    foreach ($areaCodes as $areas){
        if($area == $areas['areacode']) {
            echo "Phone number " .$number. " area code is " .$area. " which locates to " .$areas['State'].". <br> "; 
        }
    }
    $count++; 
}