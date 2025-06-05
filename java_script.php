<html>
    <head>
        <script>
            function getCurrentTime(){
                fetch('ajax_endpoint.php').then(
                    response => (
                        response.text()
                    )
                ).then(
                    data => (
                        document.getElementById('dataTimeSection').innerHTML = data 
                    )
                )
            }
        </script>
    </head>

    <body>
        <input type="button" value="What time is it?" onclick='getCurrentTime()'/>
        <p id='dataTimeSection'> The original inner HTML </p>
    </body>
</html>