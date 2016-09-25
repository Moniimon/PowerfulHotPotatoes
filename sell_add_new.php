<?php
	// Description: Sell add page for web site
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 01/09/2016

	// Call the common content that precedes the unique content.
	require_once("doc_in.php");
?>

<!-- Unique page content START -->

<h2>Sell Stock</h2>
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
        // USE ARRAY, AS MULTIPLE ITEMS CAN BE ADDED TO SALE

        $itemIndexCounter = 0;

        if (isset ($_POST["itemname_".$itemIndexCounter]))
        {
            $itemName[$itemIndexCounter] = $_POST["itemname_".$itemIndexCounter];
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
            if (isset ($_POST["itemname_".$itemIndexCounter]))
            {
                $itemName[$itemIndexCounter] = $_POST["itemname_".$itemIndexCounter];
                $itemQuantity[$itemIndexCounter] = $_POST["itemquantity_".$itemIndexCounter];

                // SANITISE INPUT TO PREVENT DIRTY HAX
                $itemName[$itemIndexCounter] = sanitise_input($itemName[$itemIndexCounter]);
                $itemQuantity[$itemIndexCounter] = sanitise_input($itemQuantity[$itemIndexCounter]);

                // VALIDATE INPUT
                
                if (strlen($itemName[$itemIndexCounter]) > 30)
                {
                    $errMsg .= "<p class=\"error\">Item name cannot exceed 30 characters.</p>";
                }

                if (!(is_numeric( $itemQuantity[$itemIndexCounter] ) && strpos( $itemQuantity[$itemIndexCounter], '.' ) === false))
                {   
                    $errMsg .= "<p class=\"error\">Item quantity must be a whole number.</p>";
                }
                else if ($itemQuantity[$itemIndexCounter] > 4294967295)
                {
                    $errMsg .= "<p class=\"error\">Item quantity cannot exceed 4294967295.</p>";
                }
                else if ($itemQuantity[$itemIndexCounter] < 0)
                {
                    $errMsg .= "<p class=\"error\">Item quantity cannot be a negative value.</p>";
                }

                $itemIndexCounter += 1;
            }
            else
            {
                $itemIndexCountComplete = true;
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

                // SUBTRACT STOCK FROM INVENTORY TABLE

                $table = "inventory";
                $query = "SET SQL_SAFE_UPDATES = 0;";

                for ($i = 0; $i < count($itemName); $i++)
                {
                    $query .=   "UPDATE $table
                                 SET item_quantity = item_quantity - $itemQuantity[$i]
                                 WHERE item_name = '$itemName[$i]';";
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
                    $debugMsg .= "<p class=\"success\">Successfully updated $table.</p>";
                    $errMsg .= "<p class=\"success\">Successfully updated database.</p>";

                    // ADD ENTRY TO SALES TABLE 

                    $table =   "sales";
                    $query =   "INSERT INTO $table (`sale_datetime`) VALUES (NOW())";
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
                        $debugMsg .= "<p class=\"success\">Successfully updated $table.</p>";
                        $errMsg .= "<p class=\"success\">Successfully updated database.</p>";
                    }

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