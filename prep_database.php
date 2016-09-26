<?php
	// Description: Checks if the database exists and creates it if it doesn't.
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 26/09/2016

    if (!mysqli_select_db($conn, $sql_db))
    {
        $debugMsg .= "<p class=\"error\">Database \"$sql_db\" does not exist... attempting to create it.</p>";

        $query = "CREATE DATABASE $sql_db";
        $result = mysqli_query($conn, $query);

        if (!$result)
        {
            $debugMsg .= "<p class=\"error\">Failed to create database \"$sql_db\".</p>";
        }
        else
        {
            $debugMsg .= "<p class=\"success\">Successfully created database \"$sql_db\".</p>";

            $query = "USE $sql_db";

            $result = mysqli_query($conn, $query);

            if (!$result)
            {
                $debugMsg .= "<p class=\"error\">Failed to switch to database \"$sql_db\": " . mysqli_error($conn) . ".</p>";
            }
            else
            {
                $debugMsg .= "<p class=\"success\">Successfully switched to database \"$sql_db\".</p>";

                $table = "inventory";

                $query = "  CREATE TABLE $table (
                            item_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            item_name VARCHAR(30) NOT NULL,
                            item_description VARCHAR(60) NOT NULL,
                            item_price FLOAT(6, 2) NOT NULL,
                            item_quantity INT(10) UNSIGNED NOT NULL
                            )";

                $result = mysqli_query($conn, $query);

                if(!$result)
                {
                    $debugMsg .= "<p class=\"error\">Failed to create table \"$table\": " . mysqli_error($conn) . ".</p>";
                }
                else
                {
                    $debugMsg .= "<p class=\"success\">Successfully created table \"$table\".</p>";

                    $table = "sales";

                    $query = "  CREATE TABLE $table (
                                sale_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                sale_datetime DATETIME NOT NULL
                                )";

                    $result = mysqli_query($conn, $query);

                    if(!$result)
                    {
                        $debugMsg .= "<p class=\"error\">Failed to create table \"$table\": " . mysqli_error($conn) . ".</p>";
                    }
                    else
                    {
                        $debugMsg .= "<p class=\"success\">Successfully created table \"$table\".</p>";

                        $table = "sold";

                        $query = "  CREATE TABLE $table (
                                    sale_id INT(6) UNSIGNED,
                                    item_id INT(6) UNSIGNED,
                                    PRIMARY KEY (sale_id, item_id),
                                    FOREIGN KEY (sale_Id) REFERENCES sales(sale_id),
                                    FOREIGN KEY (item_Id) REFERENCES inventory(item_id),
                                    sold_quantity INT(6) NOT NULL
                                    )";

                        $result = mysqli_query($conn, $query);

                        if(!$result)
                        {
                            $debugMsg .= "<p class=\"error\">Failed to create table \"$table\": " . mysqli_error($conn) . ".</p>";
                        }
                        else
                        {
                            $debugMsg .= "<p class=\"success\">Successfully created table \"$table\".</p>";
                        }
                    }
                }
            }
        }
    }
    else
    {
        $debugMsg .= "<p class=\"success\">Found database \"$sql_db\"</p>";
    }
?>