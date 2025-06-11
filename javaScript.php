<html>
    <head>
        <meta charset="UTF-8">
        <!-- <link rel='stylesheet' href=''> -->

        <style>
            .hide{
                display: none; 
            }
            .show{
                display: block; 
            }
            </style>
            
    </head> 

    <body>
        <h1> Hello World </h1>
        <script type="text/javascript">
            function ShowHiddenButton(){
                const element = document.getElementById("secretButton"); 
                element.classList.add('show');
                console.log(element.classList); 

            }
        </script>
        <div>
            <p>javascript</p>
            <a onclick="ShowHiddenButton()">Click me </a>
            <p id="secretButton" class="hide"> this is a javascript demo </p>
        </div>
    </body>
</html>
