// Description: Handles Javascript functionality of web pages
// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
// Last Edited: 01/09/2016

"use strict";

// If there is insufficient space to fill page, this function will fill it with white space.
function setPageHeight()
{
	var browserWindow = window;

	var header = document.getElementsByTagName("header")[0];
	var nav = document.getElementsByTagName("nav")[0];
	var article = document.getElementsByTagName("article")[0];
	var footer = document.getElementsByTagName("footer")[0];

	// if the combined height of all elements is less than the window height...
	if (header.offsetHeight + nav.offsetHeight + article.offsetHeight + footer.offsetHeight != browserWindow.innerHeight)
	{
		// Resize the article height to fill the screen.
		article.style.height = (browserWindow.innerHeight - (header.offsetHeight + nav.offsetHeight + footer.offsetHeight)) + "px";
	}
}

function windowWasResized()
{
	setPageHeight();
}

function init()
{
	// Get the file name of the current page.
	var page = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);

	if (page == "index.php")
	{
		// Do something
	}

	if (page == "inventory.php")
	{
		// Do something
	}

	if (page == "add.php")
	{
		// Do something
	}

	if (page == "sell.php")
	{
		// Do something
	}

	if (page == "report.php")
	{
		// Do something
	}

	if (page == "staff.php")
	{
		// Do something
	}

	if (page == "help.php")
	{
		// Do something
	}

	// Resize page after Javascript has added to the page
	setPageHeight();
}

window.onload = init;
window.onresize = windowWasResized;