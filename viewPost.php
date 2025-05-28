<?php
    include("Include/init.php"); 
    $post = getPost($_REQUEST['postId']);
    $title = $post['title']; 
    $sections = json_decode($post['sections'], true);

    echo "
        <!DOCTYPE html>
        <head>
            <meta charset='utf-8'>
            <title>".$title."</title>
            <style>
                h3:hover{
                    opacity: 0.5;
                }
                
                .container{
                    display: grid;
                    grid-template-columns: auto auto auto;
                    padding: 10px;
                    gap: 5px; 
                    background:  rgba(239, 144, 169, 0.54);
                }
                .container > div {
                    background-color:rgb(241, 241, 241);
                    border: 1px solid black;
                    padding: 5px;
                    font-size: 12px;
                    text-align: center;
                }

                .container > div:hover {
                    opacity = 0.5; 
                }

            </style>
        </head>

        <body style='background-image: url(https://media.istockphoto.com/id/539821468/vector/pink-seamless-gingham-pattern-vector.jpg?s=612x612&w=0&k=20&c=ZgLZQyyeKGQgt4gfaM9njN31XlEbgWopQ46tbOWT9y4=);'>
            
            <div style='max-width: 500px; align-items: center; margin: auto;'>   
            <h1 style='background: rgb(143, 15, 40); padding: 6px; text-align: center; color: aliceblue;' >".$title."</h1>
    ";
    foreach($sections as $header){
        echo "<div><h2 style='background: rgb(143, 15, 40); padding: 6px; text-align: center; color: aliceblue;'>".$header."</h2>"; 
    }
    echo" 
            </body>
        </html>
    ";


