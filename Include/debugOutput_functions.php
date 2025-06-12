<?php

function debugOutput($array){
    $clean = print_r( $array, true );
    echo"<pre>".$clean."</pre>";
}