<?php
	// Description: Inventory add page for web site
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 01/09/2016

	// Call the common content that precedes the unique content.
	require_once("doc_in.php");
?>

<!-- Unique page content START -->

<h2>Inventory</h2>
<section>
	<h3>Blah</h3>
	
    <?php
        $debugMsg = "<p class=\"success\">DATABASE RESPONSE: </p>";
        $errMsg = "";

        require_once("settings.php");
        require_once("connect.php");
        require_once("prep_database.php");

        function sanitise_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // CHECK THAT PAGE WAS ACCESSED VIA FORM SUBMISSION AND ASSIGN ITEMNAME

        if (isset ($_POST["itemname"]))
        {
            $itemName = $_POST["itemname"];

        }
        else
        {
            // redirect to inventory if process not triggered by form submit
            //header ("location: inventory.php");
            die("<script>location.href = 'inventory.php'</script>");
        }
        
        // ASSIGN REMAINING VALUES

        $itemDescription = $_POST["itemdescription"];
        $itemPrice = $_POST["itemprice"];
        $itemQuantity = $_POST["itemquantity"];

        // SANITISE INPUT TO PREVENT DIRTY HAX

        $itemDescription = sanitise_input($itemDescription);
        $itemPrice = sanitise_input($itemPrice);
        $itemQuantity = sanitise_input($itemQuantity);
        
        // VALIDATE INPUT

        if (strlen($itemName) > 30)
        {
            $errMsg .= "<p class=\"error\">Item name cannot exceed 30 characters.</p>";
        }

        if (strlen($itemDescription) > 60)
        {
            $errMsg .= "<p class=\"error\">Item description cannot exceed 30 characters.</p>";
        }

        if (!is_numeric($itemPrice))
        {
            $errMsg .= "<p class=\"error\">Item price must be a number and contain no commas or symbols.</p>";
        }
        else if ($itemPrice > 999999.99)
        {
            $errMsg .= "<p class=\"error\">Item price cannot exceed $999999.99.</p>";
        }
        else if ($itemPrice <= 0)
        {
            $errMsg .= "<p class=\"error\">Item price must be greater than $0.</p>";
        }

        if (!(is_numeric( $itemQuantity ) && strpos( $itemQuantity, '.' ) === false))
        {   
            $errMsg .= "<p class=\"error\">Item quantity must be a whole number.</p>";
        }
        else if ($itemQuantity > 4294967295)
        {
            $errMsg .= "<p class=\"error\">Item quantity cannot exceed 4294967295.</p>";
        }
        else if ($itemQuantity < 0)
        {
            $errMsg .= "<p class=\"error\">Item quantity cannot be a negative value.</p>";
        }

        
        // IF THERE WERE NO VALIDATION ERRORS
        if ($errMsg == "")
        {
            $errMsg .= "<p class=\"success\">Item validation succeeded.</p>";
            
            $query = "USE $sql_db";

            $result = mysqli_query($conn, $query);

            if (!$result)
            {
                // Failure
                $debugMsg .= "<p class=\"error\">Failed to switch to database $sql_db</p>";
                $errMsg .= "<p class=\"error\">Failed to add entry to database.</p>";
            }
            else
            {
                $debugMsg .= "<p class=\"success\">Successfully switched to database $sql_db.</p>";

                $table = "inventory";
                $query =    "INSERT INTO $table
                            (item_name, item_description, item_price, item_quantity)
                            VALUES
                            ('$itemName', '$itemDescription', '$itemPrice', '$itemQuantity')";

                $result = mysqli_query($conn, $query);

                if (!$result)
                {
                    // Failure
                    $debugMsg .= "<p class=\"error\">Error in query: " . $query . "</p>";
                    $errMsg .= "<p class=\"error\">Failed to add entry to database.</p>";
                }
                else
                {
                    $debugMsg .= "<p class=\"success\">Successfully added record to $table.</p>";
                    $errMsg .= "<p class=\"success\">Successfully added record to database.</p>";
                }

                if ($debugMode)
                {
                    echo $debugMsg;
                }

                echo $errMsg;
            }
        }
        else
        {
            echo $errMsg;
        }
    ?>
    <a href="inventory.php" id="biglink">Back</a>
</section>

<!-- Unique page content END -->
	
<?php
	// Call the common content that follows the unique content.
	require_once("doc_out.php");
?>