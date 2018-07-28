<?php
$conn = @mysql_connect("localhost", "root", "root") or die("Êý¾Ý¿âÁ´½Ó´íÎó");
mysql_select_db("note", $conn);
mysql_query("set names 'UTF8'"); 
?>
