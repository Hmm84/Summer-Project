<?php
    include("Include/init.php"); 
    $users = getAllUsers();
    // debugOutput($_REQUEST); 
    // $user = getUser($_REQUEST['userId']);
    // debugOutput($user); 
 
   echo "
        <!DOCTYPE html
        <head>
            <meta charset='utf-8'>
        </head>
        
        <body>
            <div>"; 
            foreach($users as $user){
                echo "<div>".$user['name']."</div>"; 
            }

        echo "
            </div>
        </body>"; 
    