<?php
include("Include/init.php"); 
debugOutput($_SESSION); 
debugOutput($_REQUEST); 

if($_REQUEST['reason'] == "loggedOut"){
    $_SESSION = []; 
}

if((isset($_REQUEST['name'])) && !empty($_REQUEST['name'])){
    if((isset($_REQUEST['password'])) && !empty($_REQUEST['password'])){
        $user = validateUser($_REQUEST['name'],$_REQUEST['password']); 
        //check if we have a user 
        if((!empty($user)) && $user['userId']){
            $_SESSION['userId'] = $user['userId']; 
            header("Location: session2.php"); 
        } else {
            echo "Try again! invalid user credientials."; 
        }
    } else {
        echo "Please enter a valid password, thanks!"; 
    }
} else {
    echo "Please enter a valid name, thank you!"; 
}

?>

<form action="" method="post">
    <input type="text" placeholder="Name"  name="name" id="name"/>
    <input type="text" placeholder="Password"  name="password" id="Comment"/>
    <input type="submit" class="button" value="submit">
</form> 