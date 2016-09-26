<?php
	// Description: Sell stock page for web site
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 26/09/2016

	// Call the common content that precedes the unique content.
	require_once("doc_in.php");
?>

<!-- Unique page content START -->

<h2>Sell Stock</h2>
<section>
	<h3>Sale Form</h3>
	<p>
		Items can be sold from here.
	</p>
	<?php
  		$debugMsg = "<p class=\"success\">DATABASE RESPONSE: </p>";
    	$errMsg = "";

	    require_once("settings.php");
	    require_once("connect.php");
	    require_once("prep_database.php");
	    require_once("utilities.php");

        if ($debugMode)
        {
        	echo $debugMsg;
        }

    	$table = "inventory";
    	$query = "SELECT item_id, item_name, item_price FROM $table";

    	// Generate form

    	$result = mysqli_query($conn, $query);
    	if (!$result)
		{
			echo "<p>Something went wrong with ", $query, "</p>";
		}
		else
		{
			echo "	 <form method=\"post\" action=\"sell_add_new.php\" id=\"sellstock\" novalidate=\"novalidate\">".
					"<table id=\"itemlist\">".
					"<tr>".
			   		"<td>Item Name</td>".
			 		"<td>Item Id</td>".
			    	"<td>Item Quantity</td>".
			    	"<td>Unit Cost</td>".
			    	"<td>Total Cost</td>".
			    	"<td></td>".
		 			"</tr>".
		 			"<tr id=\"item_0\" class=\"item\">".
		 			"<td>".
		 			"<select id=\"itemname_0\" name=\"itemname_0\" class=\"itemname\">";

		  	while ($row = mysqli_fetch_assoc($result))
			{
				// Add options from MySql query
				echo "<option value=\"", $row["item_id"], "\" data-price=\"", $row["item_price"] ,"\">", $row["item_name"], "</option>";
			}
			echo "	 </select>".
					"</td>".
					"<td><input type=\"text\" id=\"itemid_0\" name=\"itemid_0\" class=\"itemid\" readonly=\"readonly\"></td>".
					"<td><input type=\"text\" id=\"itemquantity_0\" value=\"1\" name=\"itemquantity_0\" class=\"itemquantity\"></td>".
					"<td><input type=\"text\" id=\"unitcost_0\" name=\"unitcost_0\" class=\"unitcost\" readonly=\"readonly\"></td>".
					"<td><input type=\"text\" id=\"totalcost_0\" name=\"totalcost_0\" class=\"totalcost\" readonly=\"readonly\"></td>".
					"<td><input type=\"button\" class=\"additem\" value=\"Add\"></td>".
					"</tr>".
					"</table>".
					"<input type=\"submit\" value=\"Sell\">".
					"</form>";
		}
    ?>

</section>

<!-- Unique page content END -->
	
<?php
	// Call the common content that follows the unique content.
	require_once("doc_out.php");
?>