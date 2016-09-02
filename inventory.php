<?php
	// Description: Inventory page for web site
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 01/09/2016

	// Call the common content that precedes the unique content.
	require_once("doc_in.php");
?>

<!-- Unique page content START -->

<h2>Inventory</h2>
<section>
	<h3>Blah</h3>
	<p>
	<form action="" method="get/post">
<table id="Itemtable">
  <tr>
    <td>ItemName</td>
    <td>ItemDescription</td>
    <td>ItemPrice</td>
    <td>ItemQuantity</td>
  </tr>
  <tr>
    <td> <input type="text"></td>
	<td> <input type="text"></td>
	<td> <input type="Number"></td>
	<td> <input type="Number"></td>
  </tr>
   <tr>
    <td> <input type="text"></td>
	<td> <input type="text"></td>
	<td> <input type="Number"></td>
	<td> <input type="Number"></td>
  </tr>
  <tr>
    <td> <input type="text"></td>
	<td> <input type="text"></td>
	<td> <input type="Number"></td>
	<td> <input type="Number"></td>
  </tr>
  <tr>
    <td> <input type="text"></td>
	<td> <input type="text"></td>
	<td> <input type="Number"></td>
	<td> <input type="Number"></td>
  </tr>
</table>
<br>


</br>
</br>
</br>
</br>
<p>sale table</p>
<table id="saletable">
  <tr>
    <td>saleDate</td>
    <td>SaleTime</td>
    <td>itemID</td>
    <td>SoldQuantity</td>
  </tr>
    <tr>

    <td> <input type="datetime"></td>
	<td> <input type="time"></td>
	<td> <input type="Number"></td>
	<td> <input type="Number"></td>
  </tr>
    </tr>
    <tr>

    <td> <input type="datetime"></td>
	<td> <input type="time"></td>
	<td> <input type="Number"></td>
	<td> <input type="Number"></td>
  </tr>
    </tr>
    <tr>

    <td> <input type="datetime"></td>
	<td> <input type="time"></td>
	<td> <input type="Number"></td>
	<td> <input type="Number"></td>
  </tr>
    </tr>
    <tr>

    <td> <input type="datetime"></td>
	<td> <input type="time"></td>
	<td> <input type="Number"></td>
	<td> <input type="Number"></td>
  </tr>
</table>

</form>

	</p>
</section>

<!-- Unique page content END -->
	
<?php
	// Call the common content that follows the unique content.
	require_once("doc_out.php");
?>
