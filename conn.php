<?php
$conn = @mysql_connect("localhost", "root", "root") or die("���ݿ����Ӵ���");
mysql_select_db("note", $conn);
mysql_query("set names 'UTF8'"); 
?>
