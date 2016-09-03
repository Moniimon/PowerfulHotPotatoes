<?php
	// Description: Connects to the database
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 03/09/2016

	require_once("connection.php");
    $conn = @mysqli_connect($host, $user, $pwd);

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if (!$conn)
    {
        $debugMsg .= "<p class=\"error\">Failed to connect to database server:" . mysqli_connect_error() . ".</p>";
    }
    else
    {
        $debugMsg .= "<p class=\"success\">Connected to database server</p>";
    }
?>