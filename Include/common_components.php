<?php

function echoHeader($pageTitle){ 
	echo "<html>
		<head>
			<title>".$pageTitle."</title>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<meta charset='utf-8'>
			<link rel='stylesheet' href='../css/book.css'> 
			<link rel='stylesheet' href='../css/library.css'> 
			<link rel='stylesheet' href='../css/chat.css'> 
		</head>
		<body>
	"; 
}

function echoFooter(){
	echo "</body>
	</html>
	";
}