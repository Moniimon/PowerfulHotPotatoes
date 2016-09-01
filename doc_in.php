<?php
	// Description: Common code called at the beginning of each web page. Calls header, nav and content_in
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 01/09/2016

	echo
	"<!DOCTYPE html>".
	"<html lang=\"en\">".
		"<head>".
			"<meta charset=\"utf-8\"/>".
			"<meta name=\"description\" content=\"PHP Management System\"/>".
			"<meta name=\"keywords\" content=\"Inventory, Sales, Staff, Administration\"/>".
			"<meta name=\"author\" content=\"Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores\"/>".
			"<!-- Viewport set to scale 1.0 -->".
	  		"<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>".
	  		"<!-- Reference to main css file -->".
			"<link href=\"styles/main.css\" rel=\"stylesheet\"/>".
	  		"<!-- Reference to responsive CSS file -->".
	  		"<link href=\"styles/responsive.css\" rel=\"stylesheet\" media=\"screen and (max-width: 1024px)\"/>".
	  		"<script src=\"scripts/main.js\"></script>".
	  		"<title>PHP Inventory System</title>".
		"</head>".
		"<body>";
	require_once("header.php");
	require_once("nav.php");
	require_once("content_in.php");
?>