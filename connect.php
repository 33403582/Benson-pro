<?php
$con = mysql_connect("localhost", "root", "");
$db = mysql_select_db("taxi", $con);

mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection ='utf8_general_ci'") or die (mysql_error());

?>

