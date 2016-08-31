<?php

// Blah!

if($_POST['name'] == "")

{

     echo "Please input the ID<br><a href='login.php'>Back</a>";

}elseif($_POST['password'] == "")

{

     echo "Please input the password<br><a href='login.php'>Back</a>";

}else

{

     $conn = mysql_connect("localhost","root","")

         or die("cannt connect to the database".mysql_error());

     mysql_select_db("user")

         or die ("cannt connect to the user".mysql_error());

     $sql = "select * from user where id=3";

     $result = mysql_query($sql);

     $query = mysql_fetch_array($result);

     mysql_close($conn);

     if(($query['name'] == $_POST['name']) && ($query['password'] == $_POST['password']))

     {

         echo "login successful£¡<br>";

     }else

         echo "password error<br>";

     echo "<a href='login.php'>back</a>";

}

?>