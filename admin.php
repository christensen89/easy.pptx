<?php
include 'start.php';
?>
<?php
if(isset($_SESSION['bruker']))
{
	include 'script/adminloggedin.php';
}
else{
	include 'form/admin-login-form.php';
}
?>
<?php
include 'slutt.php';
?>
