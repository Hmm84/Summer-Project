<?php

date_default_timezone_set('America/Chicago'); 
session_start(); 

include('connect.php');
include('db_query.php');
include('common_components.php');
include('backend/debug_output.php'); 
include('functions/stories.php'); 
include('config.php'); 
include('functions/prompt.php'); 
include('functions/callAI.php'); 
include('functions/format.php'); 
include('functions/notionDatabase.php'); 


