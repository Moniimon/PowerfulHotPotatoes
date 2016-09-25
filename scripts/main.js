// Description: Handles Javascript functionality of web pages
// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
// Last Edited: 01/09/2016

"use strict";

var debug = false;

function formUpdate()
{
	var itemList = document.getElementById('itemlist');

	var saleArray = [];
	saleArray = document.getElementsByClassName('item');

	var i = 0;
	while (i < saleArray.length)
	{
		document.getElementById('item_' + i).getElementsByClassName('unitcost')[0].value =
			saleArray[i].getElementsByClassName('itemname')[0].childNodes[saleArray[i].getElementsByClassName('itemname')[0].selectedIndex].getAttribute('data-price');
		
		document.getElementById('item_' + i).getElementsByClassName('totalcost')[0].value =
			(saleArray[i].getElementsByClassName('itemname')[0].childNodes[saleArray[i].getElementsByClassName('itemname')[0].selectedIndex].getAttribute('data-price') *
				saleArray[i].getElementsByClassName('itemquantity')[0].value).toFixed(2);
		i++;
	}
}

// For sell page, triggered when "remove" button is clicked
function removeItemFromList()
{
	// Item list to append new item to
	var itemList = document.getElementById('itemlist');
	
	// Array of individual items in list
	var saleArray = [];
	saleArray = document.getElementsByClassName('item');

	saleArray[0].remove();

	// Set unique id's for all item elements in saleArray
	var i = 0;
	while (i < saleArray.length)
	{
		saleArray[i].id = 'item_' + i;

		saleArray[i].getElementsByClassName("itemname")[0].id = "itemname_" + i;
		saleArray[i].getElementsByClassName("itemname")[0].name = "itemname_" + i;
		
		saleArray[i].getElementsByClassName("itemquantity")[0].id = "itemquantity_" + i;
		saleArray[i].getElementsByClassName("itemquantity")[0].name = "itemquantity_" + i;

		saleArray[i].getElementsByClassName("unitcost")[0].id = "unitcost_" + i;
		saleArray[i].getElementsByClassName("unitcost")[0].name = "unitcost_" + i;

		saleArray[i].getElementsByClassName("totalcost")[0].id = "totalcost_" + i;
		saleArray[i].getElementsByClassName("totalcost")[0].name = "totalcost_" + i;

		i++;
	}

	if (saleArray.length == 1)
	{
		// Remove the remove button if there's only one item in the sale list
		document.getElementById('item_0').getElementsByClassName('removeItem')[0].remove();
	}

	formUpdate();
}

// For sell page, triggered when "add" button is clicked
function addItemToList()
{
	// Item list to append new item to
	var itemList = document.getElementById('itemlist');
	
	// Array of individual items in list
	var saleArray = [];
	saleArray = document.getElementsByClassName('item');

	// Set unique id's for all item elements in saleArray
	var i = 0;
	while (i < saleArray.length)
	{
		saleArray[i].id = 'item_' + i;
		i++;
	}

	// Clone the last instance of element with name "item" and give it and its children unique id's
	var cloneItem = document.getElementById('item_' + (i - 1));
	var newItem = cloneItem.cloneNode(true);
	
	// Set id's and name values for database submission
	newItem.id = 'item_' + i;
	newItem.name = 'item_' + i;
	
	newItem.getElementsByClassName('itemname')[0].id = 'itemname_' + i;
	newItem.getElementsByClassName('itemname')[0].name = 'itemname_' + i;

	newItem.getElementsByClassName('itemquantity')[0].id = 'itemquantity_' + i;
	newItem.getElementsByClassName('itemquantity')[0].name = 'itemquantity_' + i;

	newItem.getElementsByClassName('unitcost')[0].id = 'unitcost_' + i;
	newItem.getElementsByClassName('unitcost')[0].name = 'unitcost_' + i;

	newItem.getElementsByClassName('totalcost')[0].id = 'totalcost_' + i;
	newItem.getElementsByClassName('totalcost')[0].name = 'totalcost_' + i;

	// Set default values
	newItem.getElementsByClassName('itemquantity')[0].value = 1;

	// Remove buttons from previous list item
	cloneItem.getElementsByClassName('additem')[0].remove();
	
	if (cloneItem.contains(cloneItem.getElementsByClassName("removeItem")[0]))
	{
		// Remove the remove button from the clonee if it exists
		cloneItem.getElementsByClassName("removeItem")[0].remove();
	}
	else
	{
		// Add the remove button to current list item
		var removeButton = document.createElement("button");
		removeButton.innerHTML = "Remove";
		removeButton.className = "removeItem";
		removeButton.type = "button";
		newItem.appendChild(removeButton);
	}

	// Add event listerners
	newItem.getElementsByClassName('itemname')[0].addEventListener('change', formUpdate);
	newItem.getElementsByClassName('itemquantity')[0].addEventListener('change', formUpdate);
	newItem.getElementsByClassName('additem')[0].addEventListener('click', addItemToList);
	newItem.getElementsByClassName('removeItem')[0].addEventListener('click', removeItemFromList);

	// Add newItem to itemList
	itemList.appendChild(newItem);

	//Update form
	formUpdate();

	if (debug)
	{
		i = 0;
		var debugMsg = "";
		while (i < saleArray.length)
		{
			debugMsg += saleArray[i].id + "\n";
			i++;
		}
		alert(debugMsg);
	}
}

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
		// Set event listerner for add item button
		var addItem = document.getElementsByClassName('additem')[0];
		addItem.addEventListener('click', addItemToList);

		// Set event listener for when item selection changes
		var selectItem = document.getElementById('itemname_0');
		selectItem.addEventListener('change', formUpdate);

		// Set event listener for when item quantity changes
		var itemQuantity = document.getElementById('itemquantity_0');
		itemQuantity.addEventListener('change', formUpdate);

		formUpdate();
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