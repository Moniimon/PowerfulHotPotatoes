<?php
	// Description: Shared utilities for website
	// Authors: Andrew Hill, Ethen (Chenglong M), Jason Dally, Monii Flores
	// Last Edited: 26/09/2016
	
	function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>