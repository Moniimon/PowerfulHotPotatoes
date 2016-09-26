<?php
	// Description: Sell add page for web site
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 26/09/2016

	// Call the common content that precedes the unique content.
	require_once("doc_in.php");
?>

<!-- Unique page content START -->

<h2>Sell Stock</h2>
<section>
	<h3>Sale Form</h3>
	
    <?php
        $debugMsg = "<p class=\"success\">DATABASE RESPONSE: </p>";
        $errMsg = "";

        require_once("settings.php");
        require_once("connect.php");
        require_once("prep_database.php");
        require_once("utilities.php");

        function validate_sell_form_id($data)
        {
            if (!(is_numeric( $data ) && strpos( $data, '.' ) === false))
            {   
                $msg .= "<p class=\"error\">Item ID must be a whole number.</p>";
            }
            else if ($data > 4294967295)
            {
                $msg .= "<p class=\"error\">Item ID cannot exceed 4294967295.</p>";
            }
            else if ($data < 1)
            {
                $msg .= "<p class=\"error\">Item ID cannot be less than one.</p>";
            }
            return $msg;
        }

        function validate_sell_form_quantity($data)
        {
            if (!(is_numeric( $data ) && strpos( $data, '.' ) === false))
            {   
                $msg .= "<p class=\"error\">Item quantity must be a whole number.</p>";
            }
            else if ($data > 4294967295)
            {
                $msg .= "<p class=\"error\">Item quantity cannot exceed 4294967295.</p>";
            }
            else if ($data < 1)
            {
                $msg .= "<p class=\"error\">Item quantity cannot be less than one.</p>";
            }
            return $msg;
        }

        // CHECK THAT PAGE WAS ACCESSED VIA FORM SUBMISSION AND ASSIGN ITEMNAME
        // USE ARRAY, AS MULTIPLE ITEMS CAN BE ADDED TO SALE

        $itemIndexCounter = 0;

        if (isset ($_POST["itemid_".$itemIndexCounter]))
        {
            $itemId[$itemIndexCounter] = $_POST["itemid_".$itemIndexCounter];
        }
        else
        {
            // redirect to inventory if process not triggered by form submit
            //header ("location: inventory.php");
            die("<script>location.href = 'sell.php'</script>");
        }

        // ASSIGN REMAINING VALUES

        $itemQuantity[$itemIndexCounter] = $_POST["itemquantity_".$itemIndexCounter];

        $itemIndexCounter += 1;

        // ASSIGN VALUES FOR ADDITIONAL INDEXES
        
        $itemIndexCountComplete = false;
        while(!$itemIndexCountComplete)
        {   
            if (isset ($_POST["itemid_".$itemIndexCounter]))
            {
                $itemId[$itemIndexCounter] = $_POST["itemid_".$itemIndexCounter];
                $itemQuantity[$itemIndexCounter] = $_POST["itemquantity_".$itemIndexCounter];

                // SANITISE INPUT TO PREVENT DIRTY HAX
                $itemId[$itemIndexCounter] = sanitise_input($itemId[$itemIndexCounter]);
                $itemQuantity[$itemIndexCounter] = sanitise_input($itemQuantity[$itemIndexCounter]);

                $itemIndexCounter += 1;
            }
            else
            {
                $itemIndexCountComplete = true;
            }
        }

        // VALIDATE DATA

        for ($i = 0; $i < count($itemId); $i++)
        {
            $errMsg = validate_sell_form_id($itemId[$i]);
            $errMsg = validate_sell_form_quantity($itemQuantity[$i]);

            if ($errMsg != "")
            {
                break;
            }
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

                // INSERT SALE RECORD WITH AUTO INCREMENTED ID AND THE CURRENT DATE
                
                $table =   "sales";
                $query =   "SET SQL_SAFE_UPDATES = 0;
                            INSERT INTO $table (`sale_datetime`) VALUES (NOW());";

                // LOOP THROUGH THE NUMBER OF ITEM INDEXES SPECIFIED IN THE SALE AND SUBTRACT THE STOCK FROM THE INVENTORY TABLE
                // ALSO, ...

                for ($i = 0; $i < count($itemId); $i++)
                {
                    $table = "inventory";
                    $query .=  "UPDATE $table
                                SET item_quantity = item_quantity - $itemQuantity[$i]
                                WHERE item_id = '$itemId[$i]';";
                    $table = "sold";
                    $query .=  "INSERT INTO $table (item_id, sale_id, sold_quantity) VALUES ('$itemId[$i]', LAST_INSERT_ID(), '$itemQuantity[$i]');";
                }

                $result = mysqli_multi_query($conn, $query);

                if (!$result)
                {
                    // Failure
                    $debugMsg .= "<p class=\"error\">Error in query: " . $query . "</p>";
                    $errMsg .= "<p class=\"error\">Failed to update database.</p>";
                }
                else
                {
                    // Success
                    $debugMsg .= "<p class=\"success\">Successfully updated $table (This may not be the case...)</p>";
                    $errMsg .= "<p class=\"success\">Successfully updated database (This may not be the case...)</p>";

                    if ($debugMode)
                    {
                        echo $debugMsg;
                    }

                    echo $errMsg;
                }
            }
        }
        else
        {
            echo $errMsg;
        }
        
    ?>
    <a href="sell.php" id="biglink">Back</a>
</section>

<!-- Unique page content END -->
	
<?php
	// Call the common content that follows the unique content.
	require_once("doc_out.php");
?>