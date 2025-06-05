<?php
    include("Include/init.php"); 
    $comments = getComments(); 
   

    if(isset($_REQUEST['username']) && isset($_REQUEST['comment'])){
        insertComment($_REQUEST['username'], $_REQUEST['comment']); 
        header("location: form_practice.php");
        exit;  
    }

    if (isset($_REQUEST['delete_username'])) {
        deleteComment($_REQUEST['delete_username']);
        header("Location: form_practice.php");
        exit;
    }

    

?>


<html>
    <head>

    <link rel="stylesheet" href="style.css"> 
        <style>
            body {
                background-color: off-white; 
                color: black; 
                font-family: sans-serif; 
                min-height: 100vh;
                width: 100%;
                padding: 2.5vh 10vw;
                
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: flex-start;
            }

            h1 {
                font-size: clamp(1rem, 4vw, 10rem);
                margin: 15vh 0 2rem;
            }
            .container {
                border-radius: 5px;
                background-color: #f4f4f4;
                padding: 20px;
                width: 415px;
                
            }
            .form__input {
                width: clamp(120px, 50vw, 420px);
                height: 2.5rem;
                padding: 0 1.25rem;
                border: 1px solid black;
                border-radius: 2px;
                margin: 0.625rem auto;
                transition: all 250ms;
            }
            
            @media (min-width: 768px) {
                .form__input{
                    width: clamp(120px, 35vw, 420px);
                }
            }

            .hide{
                display: none; 
            }
            .show{
                display: block; 
            }

        </style>

        <script>
            // Showcase the comments button 
            function ShowHiddenButton(){
                const element = document.getElementById("secretButton"); 
                element.classList.add('show');
                console.log(element.classList); 
            }
        </script>
    </head>

    <body>
    <div class="container">
            <!-- Form to get comments  -->
            <h1> Comments </h1>
            <div>
                <form action="" method="post" class="form">
                    <input type="text" placeholder="Name"  name="username" class="form__input" id="name"/>
                    <input type="text" placeholder="Comment"  name="comment" class="form__input" id="Comment"/>
                    <input type="submit" class="button">
                </form> 
            </div>
            
            <!-- Form to delete a comment based on the name  -->
            <div>
                <form action="" method="post" class="form">
                    <input type="text" placeholder="Delete Name" name="delete_username" class="form__input" id="deleteName"/>
                    <input type="submit" value="Delete" class="button" name="delete" style="background-color:red">
                </form>
            </div>
            
            <!-- Button to showcase the comment section -->
            <a onclick="ShowHiddenButton()" style="font-size: clamp(1rem, 2vw, 6rem);margin: 15vh 0 2rem; font-weight: bold;" > 
                Comments Section 
            </a>

            <div id="secretButton" class="hide">
                <?php
                // An each loop to iterate through the array and output all the name and comments 
                    foreach($comments as $comment){
                        $name = $comment['name']; 
                        $content = $comment['content']; 
                        echo "<div><strong>".htmlspecialchars($name).":</strong>  ".htmlspecialchars($content)."
            </div>"; 
                    }

                    ?>
    </div>
    </body>
</html> 