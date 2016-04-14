<?php 
include 'start.php';
include 'script/login-check.php';
?>
<div class="container">
	<div class="page-header">
		<h1>Registrer fag</h1>
	</div>
<?php
	include("form/admin-fag-form.php");
	@$registrerfag=$_POST["registrerfag"];
	if($registrerfag)
	{
		$fagnavn=$_POST["fagnavn"];
		$fagkode=$_POST["fagkode"];
		$laerer=$_POST["laerer"];
		$periode=$_POST["periode"];

		if(!$fagnavn||!$fagkode||!$laerer)
		{
			print("
				<div class='container'>
				<div class='alert alert-danger'>
				<strong>Feil!</strong> noe er fylt ut feil.
				</div>
				</div>
				");
		}
		else
		{
			include("script/db-tilkobling.php");
			$sql="INSERT INTO `aulesjord2`.`fag` (`navn`, `fagkode`, `laerer_id`, `periode_id`) VALUES ('$fagnavn', '$fagkode', '$laerer', '$periode');";
			mysqli_query($db,$sql) or die("Kunne ikke registrere i db. har du kontrollert $sql ?");
			print("
			<div class='container'>
			<div class='alert alert-success'>
			<strong>Fullført!</strong> Du har registrert $fagnavn.
			</div>
			</div>
			");
		}
	}
?>
</div>
<?php include 'slutt.php';?>