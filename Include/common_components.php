<?php

function echoHeader($pageTitle){ 
	echo "<html>
		<head>
			<title>".$pageTitle."</title>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<meta charset='utf-8'>
			<link rel='stylesheet' href='../css/book.css'> 
			<link rel='stylesheet' href='../css/library.css'> 
		</head>
		<body>
	"; 
}

//If you want a footer you can add one this is the bare minimum
function echoFooter(){
	echo "</body>
	</html>
	";
}