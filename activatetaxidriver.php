<?php
include('../connect.php');

if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 

mysql_query("UPDATE taxidriver SET usertype='1' WHERE id='$id'");

header("location: taxidriverlist.php");

}
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {
 header("Location: taxidriverlist.php");
 }
 
?>