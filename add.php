<?php
	// Description: Add stock page for web site
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 26/09/2016

	// Call the common content that precedes the unique content.
	require_once("doc_in.php");
?>

<!-- Unique page content START -->

<h2>Add Stock</h2>
<section>
	<h3>Restock Form</h3>
	<p>
		Items can be restocked from here.
	</p>

	<?php
        $debugMsg = "<p class=\"success\">DATABASE RESPONSE: </p>";
        $errMsg = "";

        require_once("settings.php");
        require_once("connect.php");
        require_once("prep_database.php");
        require_once("utilities.php");

        echo $debugMsg;
        echo $errMsg;
    ?>
</section>

<!-- Unique page content END -->
	
<?php
	// Call the common content that follows the unique content.
	require_once("doc_out.php");
?>