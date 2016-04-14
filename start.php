<?php
session_start();
include 'script/db-tilkobling.php';
@$script="";
if(isset($_SESSION['bruker'])){
	$script="script/admin-start.php";
}
else if(isset($_SESSION['loggedin'])){
	$script="script/bruker-start.php";
}	
else{
	$script="script/vanlig-start.php";
}
 include 'head.html';
 include $script;
?>
