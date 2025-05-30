<?php
    include("Include/init.php"); 
    $post = getPost($_REQUEST['postId']);
    $title = $post['title']; 
    $sections = json_decode($post['sections'], true); 
    $links = json_decode($post['Link'], true);

    echo "
        <!DOCTYPE html>
        <head>
            <meta charset='utf-8'>
            <title>".$title."</title>
            <style>
                h3:hover{
                    opacity: 0.5;
                }

                a:hover{
                    opacity: 0.5;
                }
            
                .container{
                    display: grid;
                    grid-template-columns: auto auto auto;
                    padding: 10px;
                    gap: 5px;
                    font-size: 45px; 
                    position: relative; 
                    right: 255px;
                    width: 1000px;
                }

                .container > div {
                    background-color: rgb(229 229 229);
                    border: 1px solid #1c5b5d;
                    padding: 5px;
                    font-size: 15px;
                    text-align: center;
                    font-family: system-ui;
                    color: #1c5b5d; 
                }

                .container > div:hover {
                    opacity = 0.5; 
                }

            </style>
        </head>

        <body style='background: cadetblue;'>
            
            <div style='max-width: 500px; align-items: center; margin: auto;'>   
            <h1 style='background: rgb(28, 91, 93);
                    position: relative;
                    right: 250px;
                    width: 1000px;
                    padding: 6px;
                    text-align: center;
                    border: 2px double #609ea0;
                    font-family: system-ui;
                    color: aliceblue;' >".$title."</h1>
        "; 
    
    $count = 1; 
    foreach($sections as $header => $classes){
        echo "<div><a href='".$links[$count]."'style='background: rgb(28 91 93);
                    position: relative;
                    right: 250px;
                    width: 1000px;
                    padding: 6px;
                    text-align: center;
                    font-family: system-ui;
                    color: aliceblue;
                    display: block;
                    margin: 16px 0 15px 0;
                    font-size: 25px;
                    text-decoration: none;
                    border: 2px double #609ea0;'>".$header."</a>
                </div>"; 
        
        // ForEach loop approach
        echo " <div class=container>";
        foreach($classes as $class){
            echo "
                <div><h3>".$class."</h3></div>"; 
        }
        echo "</div>";

        // Counter for links index
        $count += 1; 
    }

    echo "
            </body>
        </html>
    ";


