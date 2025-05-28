<?php
	function echoHeader($pageTitle){ 
			echo "
			    <html>
			        <head>
			            <title>".$pageTitle."</title>
			            <link rel='stylesheet' type='text/css' href='/style.css'
			        </head>
			        <body>		            
			                <div class='navbar'>
				                <a href='/logout.php'> LogOut </a>
				                <a href='/user.php'> Profile </a>
				                <a href='/jobsForPerson.php'> Jobs </a>
			                </div>          
			";
	}

//If you want a footer you can add one this is the bare minimum
function echoFooter(){
	echo "
			</body>
		</html>
	";
}