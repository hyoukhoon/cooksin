<?php session_start(); 
	include $_SERVER['DOCUMENT_ROOT']."/inc/dbconn.php";
	
	SetCookie("cookieSaveLoginInfo","",time()-86400*365,"/");

	session_destroy();
	location_is('/','','');
?>