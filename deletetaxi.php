<?php
include('../connect.php');
$id = $_GET['id'];
$result = mysql_query("SELECT * FROM taxi WHERE id='$id'");

while($row = mysql_fetch_array($result))
  {
    $id=$row['id'];
    $imagelocation=$row['imagelocation'];
  }
?>	
<?php
/* 
 DELETE.PHP
 Deletes a specific entry from the 'customers' table
*/

 // connect to the database
 include('../connect.php');
 
 // check if the 'serial' variable is set in URL, and check that it is valid
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 // delete the entry
 $result = mysql_query("DELETE FROM taxi WHERE id=$id")
 or die(mysql_error()); 
 unlink($imagelocation);
 //$result = mysql_query("DELETE FROM order_detail WHERE orderid=$orderid")
 //or die(mysql_error());
 
 // redirect back to the view page
 header("Location: taxilist.php");
 }
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {
 header("Location: taxilist.php");
 }
 
?>