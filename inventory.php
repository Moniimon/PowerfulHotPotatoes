<?php
	// Description: Inventory page for web site
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 26/09/2016

	// Call the common content that precedes the unique content.
	require_once("doc_in.php");
?>

<!-- Unique page content START -->

<h2>Inventory</h2>
<section>
	<h3>Current Items</h3>
	<p>The table below lists the items currently in the inventory and available for sale.</p> 	
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
        $query = "SELECT * FROM $table";

        $result = mysqli_query($conn, $query);

		if (!$result)
		{
			echo "<p>Something went wrong with ", $query, "</p>";
		}
		else
		{
			echo 	"<table id=\"itemtable\">".
					"<tr>".
					"<th scope=\"col\">Item ID</th>".
					"<th scope=\"col\">Item Name</th>".
					"<th scope=\"col\">Item Description</th>".
					"<th scope=\"col\">Item Price</th>".
					"<th scope=\"col\">Item Quantity</th>".
					"</tr>";

			while ($row = mysqli_fetch_assoc($result))
			{
				echo "<tr>";
				echo "<td>", $row["item_id"], "</td>";
				echo "<td>", $row["item_name"], "</td>";
				echo "<td>", $row["item_description"], "</td>";
				echo "<td>", $row["item_price"], "</td>";
				echo "<td>", $row["item_quantity"], "</td>";
				echo "</tr>";
			}
			echo "</table>";

			mysqli_free_result($result);
		}
	?>		   
	</br>
	<h3>Add New Item</h3>
	<p>Fill out the form bellow to add another item to the inventory.</p>
	<form method="post" action="inventory_add_new.php" id="additem" novalidate="novalidate" >
		<table>
			<tr>
			    <td>Item Name</td>
			    <td>Item Description</td>
			    <td>Item Price</td>
			    <td>Item Quantity</td>
		 	</tr>
		  	<tr>
			  	<td> <input type="text" id="itemname" name="itemname"></td>
				<td> <input type="text" id="itemdescription" name="itemdescription"></td>
				<td> <input type="text" id="itemprice" name="itemprice"></td>
				<td> <input type="text" id="itemquantity" name="itemquantity"></td>
			</tr>
		</table>
		<input type="submit" value="Add">
	</form>	
</section>

<!-- Unique page content END -->
	
<?php
	// Call the common content that follows the unique content.
	require_once("doc_out.php");
?>
