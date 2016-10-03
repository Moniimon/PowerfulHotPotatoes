<?php
	// Description: Sales report page for web site
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 26/09/2016

	// Call the common content that precedes the unique content.
	require_once("doc_in.php");
?>

<!-- Unique page content START -->

<h2>Report</h2>
<section>
	<h3>Sales Report</h3>
	<p>
		A report of all selling of stock can go here (could probably include a report for stock that was added, as well).
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

        $query = 	"SELECT sold.sale_id, sales.sale_datetime, sold.item_id, inventory.item_name, sold.sold_quantity ".
					"FROM sold ".
					"join inventory ON inventory.item_id = sold.item_id ".
					"join sales ON sales.sale_id = sold.sale_id;";

        $result = mysqli_query($conn, $query);

        if (!$result)
		{
			echo "<p>Something went wrong with ", $query, "</p>";
		}
		else
		{
			echo 	"<table id=\"reporttable\">".
					"<tr>".
					"<th scope=\"col\">Sale ID</th>".
					"<th scope=\"col\">Time of Sale</th>".
					"<th scope=\"col\">Item ID</th>".
					"<th scope=\"col\">Sold Quantity</th>".
					"<th scope=\"col\">Item Name</th>".
					
					"</tr>";

			//Create link to CSV file
			echo "<a href=\"report.csv\" id=\"reportdownload\">Download CSV Report</a>";

			//Open CSV file for writing
			$writeCSV = fopen("report.csv", "w");
			$writeText = "Sale ID, Sale Date, Item ID, Item Name, Sold Quantity";

			$loopId = "";
			while ($row = mysqli_fetch_assoc($result))
			{	
				echo "<tr>";
				
				// Only print the sale Id and sale date once
				if ($row["sale_id"] != $loopId)
				{
					echo "<td>", $row["sale_id"], " <input type=\"button\" id=\"edititem_", $row["sale_id"],"\" class=\"edititem\" value=\"Edit\">", "</td>";
					echo "<td>", $row["sale_datetime"], "</td>";
				}
				else
				{
					echo "<td></td>";
					echo "<td></td>";
				}
				echo "<td>", $row["item_id"], "</td>";
				echo "<td>", $row["item_name"], "</td>";
				echo "<td>", $row["sold_quantity"], "</td>";
				echo "</tr>";
				
				$loopId = $row["sale_id"];

				// Write row values to variables for CSV write
				$writeSaleId = $row["sale_id"];
				$writeSaleDateTime = $row["sale_datetime"];
				$writeItemId = $row["item_id"];
				$writeItemName = $row["item_name"];
				$writeSoldQuantity = $row["sold_quantity"];

				// Store row variables in string and write string to CSV file
				$writeText = "$writeSaleId, $writeSaleDateTime, $writeItemId, $writeItemName, $writeSoldQuantity\n";
				fwrite($writeCSV, $writeText);
			}
			echo "</table>";

			// Free query memory
			mysqli_free_result($result);

			// CSV Write complete, close file
			fclose($writeCSV);
		}
    ?>
</section>

<!-- Unique page content END -->
	
<?php
	// Call the common content that follows the unique content.
	require_once("doc_out.php");
?>