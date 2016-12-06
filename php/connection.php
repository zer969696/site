<?php
	
    $db = mysql_connect ("localhost","root","");
    mysql_select_db ("timetable", $db);
	
	ini_set('default_charset', 'UTF-8');
	mysql_set_charset("utf8");
	mysql_query('SET NAMES utf8', $db); 
?>