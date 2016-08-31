<?php

$db = mysql_connect("localhost","root","") or die("connect to database fail");

if(!mysql_query("create database if not exists `user`"))

{

     echo "creat database fail<br>";

}else

{

     echo "connect to database succseeful£¡<br>";

}

mysql_query("use user;");

$sql ="Create TABLE if not exists `user` ("

         ." `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,"

         ." `name` VARCHAR(10) NOT NULL,"

         ." `password` VARCHAR(16) NOT NULL"

         ." )";

if(!mysql_query($sql))

{

     echo "creat chart fail£¡<br>";

}else

{

     echo "creat chart succseeful£¡<br>";

}

$sql = "Insert INTO `user` ( `name`, `password`) VALUES ( 'php-fish', '123');";

if(mysql_query($sql))

echo "add user succseeful£¡<br>";

else

echo "add user fail£¡<br>";

mysql_close($db);

?>
