<?php
	// Description: Staff page for web site
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 26/09/2016

	// Call the common content that precedes the unique content.
	require_once("doc_in.php");
?>

<!-- Unique page content START -->

<h2>Staff</h2>
<section>
	<h3>Current Staff</h3>
	<p>
		A list of all staff and their roles will go here.
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